<?php

use app\exporters\Exporter;
use Web\Geo;

class CtrlNutriVin {
    function home(Base $f3) {
        echo View::instance()->render('layout_home.html.php');
    }

    function setup(Base $f3) {
        $qrcode = new QRCode();
        if (!$qrcode->tableExists()) {
            QRcode::createTable();
        }
        $f3->set('content','admin_setup.html.php');
        echo View::instance()->render('layout.html.php');

    }

    private function authenticatedUserOnly(Base $f3) {
        if ( !$f3->exists('SESSION.userid') || !$f3->exists('PARAMS.userid') ||
             ($f3->get('PARAMS.userid') != $f3->get('SESSION.userid'))
        {
            die('Unauthorized');
        }
        return true;
    }

    function qrcodeWrite(Base $f3) {
        if ($f3->exists('POST.domaine_nom') && $f3->exists('PARAMS.userid')) {
            $this->authenticatedUserOnly($f3);
            if ($f3->exists('POST.id')) {
                $qrcode = QRCode::findById($f3->get('POST.id'));
            } else {
                // ?? Ce code sert ??
                $qrcode = new QRCode($f3->get('DB'));
            }

            if ($qrcode->user_id && $qrcode->user_id != $f3->get('PARAMS.userid')) {
                return $f3->reroute('/qrcode/'.$f3->get('userid').'/create', false);
            }

            $qrcode->copyFrom('POST');
            if (!$qrcode->user_id) {
                $qrcode->user_id = $f3->get('PARAMS.userid');
            }
            foreach(['image_bouteille', 'image_etiquette', 'image_contreetiquette'] as $img) {
                if(isset($_FILES[$img]) && in_array($_FILES[$img]['type'], array('image/jpeg', 'image/png'))) {
                    $qrcode->{$img} = 'data:'.$_FILES[$img]['type'].';base64,'.base64_encode(file_get_contents($_FILES[$img]['tmp_name']));
                }
            }
            $qrcode->save();
            return $f3->reroute('/qrcode/'.$qrcode->user_id.'/parametrage/'.$qrcode->getId(), false);
        }
        return $f3->reroute('/qrcode', false);
    }

    function qrcodeDeleteImage(Base $f3) {
        $this->authenticatedUserOnly($f3);
        $qrcode = QRCode::findById($f3->get('PARAMS.qrcodeid'));
        if ($qrcode->user_id != $f3->get('PARAMS.userid')) {
            throw new Exception('not allowed');
        }
        $images = ['image_bouteille', 'image_etiquette', 'image_contreetiquette'];
        $qrcode->{$images[intval($f3->get('PARAMS.index'))]} = null;
        $qrcode->save();
        return $f3->reroute('/qrcode/'.$qrcode->user_id.'/edit/'.$qrcode->getId()."#photos", false);
    }

    function initDefaultOnQRCode(& $qrcode){
        if (!$qrcode->image_bouteille) {
            $qrcode->image_bouteille = '/images/default_bouteille.jpg';
        }
        if (!$qrcode->image_etiquette) {
            $qrcode->image_etiquette = '/images/default_etiquette.jpg';
        }
        if (!$qrcode->image_contreetiquette) {
            $qrcode->image_contreetiquette = '/images/default_contreetiquette.jpg';
        }
    }

    function qrcodeCreate(Base $f3) {
        $this->authenticatedUserOnly($f3);
        $qrcode = new QRCode();
        if (!$qrcode->tableExists()) {
            return $f3->reroute('/admin/setup', false);
        }
        $qrcode->user_id = $f3->get('PARAMS.userid');
        $qrcode->copyFrom('GET');

        $this->initDefaultOnQRCode($qrcode);

        $f3->set('qrcode', $qrcode);
        $f3->set('content','qrcode_form.html.php');
        echo View::instance()->render('layout.html.php');
    }


    function qrcodeEdit(Base $f3) {
        $this->authenticatedUserOnly($f3);
        $qrcode = QRCode::findById($f3->get('PARAMS.qrcodeid'));
        if ($qrcode->user_id != $f3->get('PARAMS.userid')) {
            throw new Exception('not allowed');
        }

        $this->initDefaultOnQRCode($qrcode);

        $f3->set('qrcode', $qrcode);
        $f3->set('content','qrcode_form.html.php');
        echo View::instance()->render('layout.html.php');
    }

    function qrcodeAuthentication(Base $f3) {
        $qrcode = new QRCode();
        if (!$qrcode->tableExists()) {
            return $f3->reroute('/admin/setup', false);
        }
        if (!$f3->exists('SESSION.userid')) {
            if ($f3->exists('SESSION.authtype')) {
                return $f3->reroute('/logout');
            }
            $config = $f3->get('config');
            if (isset($config['http_auth']) && $config['http_auth']) {
                if (isset($_SERVER['PHP_AUTH_USER'])) {
                    $f3->set('SESSION.userid', $_SERVER['PHP_AUTH_USER']);
                    $f3->set('SESSION.username', $_SERVER['PHP_AUTH_USER']);
                    $f3->set('SESSION.authtype', 'http');
                    return $f3->reroute('/qrcode');
                }
                header('WWW-Authenticate: Basic realm="My Realm"');
                header('HTTP/1.0 401 Unauthorized');
                die ("Not authorized qrcodeAuthentication");
            }
            if (!in_array($_SERVER['SERVER_NAME'], ['127.0.0.1', 'localhost']) && !isset($config['viticonnect_baseurl'])) {
                $config['viticonnect_baseurl'] = 'https://viticonnect.net/cas';
            }
            if (isset($config['viticonnect_baseurl']) && $config['viticonnect_baseurl']) {
                return $f3->reroute($config['viticonnect_baseurl'].'/login?service='.$f3->get('urlbase').'/login/viticonnect');
            }
            if (in_array($_SERVER['SERVER_NAME'], ['127.0.0.1', 'localhost'])) {
                if (!isset($config['default_user'])) {
                    $config['default_user'] = 'userid';
                }
                $f3->set('SESSION.userid', $config['default_user']);
                $f3->set('SESSION.username', $config['default_user']);
                $f3->set('SESSION.authtype', 'default');
                return $f3->reroute('/qrcode');
            }
            die ("Not authorized");
        }
        return $f3->reroute('/qrcode/'.$f3->get('SESSION.userid').'/list', false);
    }

    function qrcodeViticonnect(Base $f3) {
        $ticket = $f3->get('GET.ticket');
        $config = $f3->get('config');
        if (!$ticket) {
            return $f3->reroute('/qrcode');
        }
        if (!isset($config['viticonnect_baseurl']) || !$config['viticonnect_baseurl']) {
            return $f3->reroute('/');
        }
        $validate = file_get_contents($config['viticonnect_baseurl'].'/serviceValidate?service='.$f3->get('urlbase').'/login/viticonnect&ticket='.$ticket);
        if ($validate) {
            if(strpos($validate, 'INVALID_TICKET') !== false) {
                return $f3->reroute('/qrcode');
            }
            $userid = null;
            $origin = null;
            $raison_sociale = null;
            if (preg_match('/<cas:viticonnect_origin>([^<]*)<\/cas:viticonnect_origin>/', $validate, $m)) {
                $origin = $m[1];
            }
            if (preg_match('/cas:viticonnect_entity_1_raison_sociale>([^<]*)<\/cas:viticonnect_entity_1/', $validate, $m)) {
                $raison_sociale = $m[1];
            }
            if (preg_match('/cas:viticonnect_entity_1_cvi>([^<]*)<\/cas:viticonnect_entity_1/', $validate, $m)) {
                $userid = $m[1];
            }
            if (!$userid && preg_match('/cas:viticonnect_entity_1_siret>([^<]*)<\/cas:viticonnect_entity_1/', $validate, $m)) {
                $userid = $m[1];
            }
            if (!$userid && $origin && preg_match('/cas:user>([^<]*)<\/cas:user/', $validate, $m)) {
                $userid = $origin.':'.$m[1];
            }
            if ($userid) {
                if ($raison_sociale) {
                    $f3->set('SESSION.username', $raison_sociale);
                }
                $f3->set('SESSION.userid', $userid);
                $f3->set('SESSION.authtype', 'viticonnect');
            }
        }
        return $f3->reroute('/qrcode');
    }

    function qrcodeDisconnect(Base $f3) {
        $f3->clear('SESSION.userid');
        $f3->clear('SESSION.username');
        if ($f3->get('SESSION.authtype') == 'viticonnect') {
            $f3->clear('SESSION.authtype');
            $config = $f3->get('config');
            return $f3->reroute($config['viticonnect_baseurl'].'/logout?service='.$f3->get('urlbase').'/');
        } elseif ($f3->get('SESSION.authtype') == 'http') {
            if ($f3->exists('SESSION.disconnection')) {
                $f3->clear('SESSION.authtype');
                $f3->clear('SESSION.disconnection');
                return $f3->reroute('/qrcode');
            }
            $f3->set('SESSION.disconnection', true);
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            die ("Not authorized qrcodeAuthentication");
        }
        $f3->clear('SESSION.authtype');
        return $f3->reroute('/');
    }

    function qrcodeList(Base $f3) {
      $this->authenticatedUserOnly($f3);
      if ($f3->exists('PARAMS.userid')) {
        $f3->set('qrlist', QRCode::findByUserid($f3->get('PARAMS.userid')));
        $f3->set('userid', $f3->get('PARAMS.userid'));
        $f3->set('content', 'qrcode_list.html.php');
        echo View::instance()->render('layout.html.php');
      }
    }

    public function qrcodeDuplicate(Base $f3) {
        $qrcode = QRCode::findById($f3->get('PARAMS.qrcodeid'));
        $fields = $qrcode->toArray();
        return $f3->reroute('/qrcode/'.$qrcode->user_id.'/create?'.http_build_query($fields), false);
    }

    public function qrcodeView(Base $f3)
    {
        $qrcode = QRCode::findById($f3->get('PARAMS.qrcodeid'));

        if ($qrcode === null) {
            $f3->error(404, "QRCode non trouvé");
            exit;
        }

        if (! $f3->get('SESSION.userid')) {
            $geo = Geo::instance();
            $location = $geo->location();
            unset($location['request'], $location['delay'], $location['credit']);
            $qrcode->addVisite(['date' => date('Y-m-d H:i:s'), 'location' => $location]);
            $qrcode->save();
        }

        $this->initDefaultOnQRCode($qrcode);

        $f3->set('content', 'qrcode_show.html.php');
        $f3->set('qrcode', $qrcode);
        $f3->set('publicview', true);
        if ($f3->get('GET.notpublicview')) {
          $f3->set('publicview', false);
        }
        echo View::instance()->render('layout_public.html.php');
    }

    public function qrcodeParametrage(Base $f3) {
        $this->authenticatedUserOnly($f3);
        $qrcode = $f3->get('PARAMS.qrcodeid');

        $qrcode = QRCode::findById($qrcode);
        if ($qrcode === null) {
            $f3->error(404, "QRCode non trouvé");
            exit;
        }
        $f3->set('qrcode', $qrcode);

        $f3->set('content', 'qrcode_parametrage.html.php');
        echo View::instance()->render('layout.html.php');
    }

    public function qrcodeDisplay(Base $f3) {
        $qrcode = QRCode::findById($f3->get('PARAMS.qrcodeid'));
        $qrcode->logo = (bool)$f3->get('POST.logo');
        $qrcode->save();
        return $f3->reroute('/qrcode/'.$qrcode->user_id.'/parametrage/'.$qrcode->getId(), false);
    }

    public function qrcodeMultiExport(Base $f3) {
        $qrcodes = $f3->get('GET.qrcodes');
        $formats = ['svg', 'pdf', 'eps'];
        $config = $f3->get('config');
        $options = isset($config['qrcode']) ? $config['qrcode'] : [];
        $userid = null;


        foreach ($qrcodes as $qr) {
            $qr = QRCode::findById($qr);
            if ($qr === null) {
                $f3->error(404, "QRCode non trouvé");
                exit;
            }

            if ($qr->user_id != $f3->get('PARAMS.userid')) {
                throw new Exception('not allowed');
            }
            $userid = $qr->user_id;

            foreach ($formats as $format) {
                $files[$format][$qr->getId()] = $qr->getQRCodeContent($format, $f3->get('urlbase'), $options);
            }
        }

        $name = tempnam(sys_get_temp_dir(), "qrcodes");
        $zip = new ZipArchive;
        if ($zip->open($name, ZipArchive::OVERWRITE) === TRUE) {
                foreach ($files as $format => $id) {
                    foreach ($id as $id => $content) {
                        $zip->addFromString($format.'/'.$id, $content);
                    }
                }
                $zip->close();
            }

        header('Content-type: application/zip');
        header('Content-disposition: attachment; filename=qrcodes_'.$userid.'.zip');
        readfile($name);
    }

    public function export(Base $f3)
    {
        $qrcode = QRCode::findById($f3->get('PARAMS.qrcodeid'));

        if ($qrcode === null) {
            $f3->error(404, "QRCode non trouvé");
            exit;
        }

        Exporter::getInstance()->setResponseHeaders($f3->get('PARAMS.format'));

        echo $qrcode->getQRCodeContent($f3->get('PARAMS.format'), $f3->get('urlbase'), $f3->get('config')['qrcode']);
    }
}

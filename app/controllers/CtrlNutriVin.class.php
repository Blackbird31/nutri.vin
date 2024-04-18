<?php

use app\exporters\Exporter;

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

    function qrcodeWrite(Base $f3) {
        if ($f3->exists('POST.domaine_nom') && $f3->exists('PARAMS.userid')) {

            if ($f3->exists('POST.id')) {
                $qrcode = QRCode::findById($f3->get('POST.id'));
            } else {
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
            $qrcode = QRCode::findById($qrcode->id);
            return $f3->reroute('/qrcode/'.$qrcode->user_id.'/list', false);
        }
        return $f3->reroute('/qrcode', false);
    }

    function qrcodeDeleteImage(Base $f3) {
        $qrcode = QRCode::findById($f3->get('PARAMS.id'));
        if ($qrcode->user_id != $f3->get('PARAMS.userid')) {
            throw new Exception('not allowed');
        }
        $images = ['image_bouteille', 'image_etiquette', 'image_contreetiquette'];
        $qrcode->{$images[intval($f3->get('PARAMS.index'))]} = null;
        $qrcode->save();
        return $f3->reroute('/qrcode/'.$qrcode->user_id.'/edit/'.$qrcode->id."#photos", false);
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
        $qrcode = new QRCode();
        if (!$qrcode->tableExists()) {
            return $f3->reroute('/admin/setup', false);
        }
        $qrcode->user_id = $f3->get('PARAMS.userid');

        $this->initDefaultOnQRCode($qrcode);

        $f3->set('qrcode', $qrcode);
        $f3->set('content','qrcode_form.html.php');
        echo View::instance()->render('layout.html.php');
    }


    function qrcodeEdit(Base $f3) {
        $qrcode = QRCode::findById($f3->get('PARAMS.id'));
        if ($qrcode->user_id != $f3->get('PARAMS.userid')) {
            throw new Exception('not allowed');
        }

        $this->initDefaultOnQRCode($qrcode);

        $f3->set('qrcode', $qrcode);
        $f3->set('content','qrcode_form.html.php');
        echo View::instance()->render('layout.html.php');
    }

    function qrcodeAuthentication(Base $f3) {
        return $f3->reroute('/qrcode/userid/create', false);
    }

    function qrcodeList(Base $f3) {
      if ($f3->exists('PARAMS.userid')) {
        $f3->set('qrlist', QRCode::findByUserid($f3->get('PARAMS.userid')));
        $f3->set('userid', $f3->get('PARAMS.userid'));
        $f3->set('content', 'qrcode_list.html.php');
        echo View::instance()->render('layout.html.php');
      }
    }

    public function qrcodeView(Base $f3)
    {
        $qrcode = QRCode::findById($f3->get('PARAMS.qrcodeid'));

        if ($qrcode === null) {
            $f3->error(404, "QRCode non trouvé");
            exit;
        }

        $this->initDefaultOnQRCode($qrcode);

        $f3->set('content', 'qrcode_show.html.php');
        $f3->set('qrcode', $qrcode);
        echo View::instance()->render('layout.html.php');
    }

    public function export(Base $f3)
    {
        $format = $f3->get('PARAMS.format');
        $qrcode = $f3->get('PARAMS.qrcodeid');

        $qrcode = QRCode::findById($qrcode);

        if ($qrcode === null) {
            $f3->error(404, "QRCode non trouvé");
            exit;
        }

        $config = $f3->get('config');
        $options = isset($config['qrcode']) ? $config['qrcode'] : [];
        $logo = isset($options['logo']) ? $options['logo'] : false;

        $data = $f3->get('urlbase').$f3->build('/@qrcodeid');

        $e = Exporter::renderer($format, $options);

        if ($logo) {
            $e->addLogo($logo);
        }

        echo $e->render($data);
    }
}

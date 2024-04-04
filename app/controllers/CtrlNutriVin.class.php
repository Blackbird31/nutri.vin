<?php

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
            if(isset($_FILES['etiquette']) && in_array($_FILES['etiquette']['type'], array('image/jpeg', 'image/png'))) {
                $qrcode->etiquette = 'data:'.$_FILES['etiquette']['type'].';base64,'.base64_encode(file_get_contents($_FILES['etiquette']['tmp_name']));
            }
            $qrcode->save();
            $qrcode = QRCode::findById($qrcode->id);
            return $f3->reroute('/qrcode/'.$qrcode->user_id.'/edit/'.$qrcode->id, false);
        }
        return $f3->reroute('/qrcode', false);
    }

    function qrcodeDeleteImage(Base $f3) {
        $qrcode = QRCode::findById($f3->get('PARAMS.id'));
        if ($qrcode->user_id != $f3->get('PARAMS.userid')) {
            throw new Exception('not allowed');
        }
        $qrcode->etiquette = null;
        $qrcode->save();
        return $f3->reroute('/qrcode/'.$qrcode->user_id.'/edit/'.$qrcode->id, false);
    }

    function qrcodeCreate(Base $f3) {
        $qrcode = new QRCode();
        if (!$qrcode->tableExists()) {
            return $f3->reroute('/admin/setup', false);
        }
        $qrcode->user_id = $f3->get('PARAMS.userid');

        $f3->set('qrcode', $qrcode);
        $f3->set('content','qrcode_form.html.php');
        echo View::instance()->render('layout.html.php');
    }


    function qrcodeEdit(Base $f3) {
        $qrcode = QRCode::findById($f3->get('PARAMS.id'));
        if ($qrcode->user_id != $f3->get('PARAMS.userid')) {
            throw new Exception('not allowed');
        }
        $f3->set('qrcode', $qrcode);
        $f3->set('content','qrcode_form.html.php');
        echo View::instance()->render('layout.html.php');
    }

    function qrcodeAuthentication(Base $f3) {
        return $f3->reroute('/qrcode/userid/create', false);
    }

}

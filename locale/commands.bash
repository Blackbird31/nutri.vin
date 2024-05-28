#fichier pas encore mis en forme les commandes utilisées sont a but de test

xgettext --from-code=utf-8 --no-location --output=./locale/application.pot *.php app/views/qrcode_show.html.php app/models/QRCode.class.php


msgmerge --update -N ./locale/en_EN/LC_MESSAGES/application.po ./locale/application.pot


msgfmt locale/en_US/LC_MESSAGES/application.po --output-file="locale/en_US/LC_MESSAGES/application.mo"

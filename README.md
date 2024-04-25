# nutri.vin

Plateforme open source et communautaire de QRCode pour la déclaration nutritionnelle de vos vins.

## Installation

Installation des dépendances :
```
sudo apt-get install php-zip php-mbstring librsvg2-bin
```

## Dépendances


### Requis

L'extension PHP `mbstring` est requis pour faire fonctionner la lib de qrcode.
Pour exporter de multiples fichiers l'extension `zip-archive` est requise.

### Optionnelles

Pour avoir un logo dans les qrcodes au format `eps` et `pdf`, il faut avoir [`rsvg-convert`](https://gitlab.gnome.org/GNOME/librsvg)

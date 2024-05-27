<?php

use app\exporters\Exporter;

require_once('Mapper.php');

class QRCode extends Mapper
{
    const VERSION_KEY_DATEFORMAT = 'Y-m-d H:i:s';

    public static $CHARID = 'azertyuiopqsdfghjklmwxcvbn'.
                            'AZERTYUIOPQSDFGHJKLMWXCVBN'.
                            '0123456789';
    public static $LABELS = ["HVE", "Demeter", "Biodyvin"];

    public static $versionning_ignore_fields = [
      'authorization_key',
      'date_version',
      'logo',
      'visites',
      'versions'
    ];

	public static $copy_field_filter = [
		"domaine_nom" => 1,
		"adresse_domaine" => 1,
		"cuvee_nom" => 1,
		"appellation" => 1,
		"couleur" => 1,
		"millesime" => 1,
		"alcool_degre" => 1,
		"centilisation" => 1,
		"lot" => 1,
		"ingredients" => 1,
		"nutritionnel_energie_kj" => 1,
		"nutritionnel_energie_kcal" => 1,
		"nutritionnel_graisses" => 1,
		"nutritionnel_acides_gras" => 1,
		"nutritionnel_glucides" => 1,
		"nutritionnel_sucres" => 1,
		"nutritionnel_proteines" => 1,
		"nutritionnel_sel" => 1,
		"nutritionnel_sodium" => 1,
		"image_bouteille" => 1,
		"image_etiquette" => 1,
		"image_contreetiquette" => 1,
		"autres_infos" => 1,
		"authorization_key" => 1,
    "labels" => 1,
    "versions" => 1,
  ];

    public static $getFieldsAndType = [
        /* $fields[$id] => 'VARCHAR(255) PRIMARY KEY', */
        'user_id' => 'VARCHAR(255)',
        'domaine_nom' => 'VARCHAR(255)',
        'adresse_domaine' => 'VARCHAR(255)',
        'appellation' => 'VARCHAR(255)',
        'couleur' => 'VARCHAR(255)',
        'cuvee_nom' => 'VARCHAR(255)',
        'alcool_degre' => 'FLOAT',
        'centilisation' => 'FLOAT',
        'millesime' => 'VARCHAR(255)',
        'lot' => 'VARCHAR(255)',
        'ingredients' => 'TEXT',
        'nutritionnel_energie_kj' => 'FLOAT',
        'nutritionnel_energie_kcal' => 'FLOAT',
        'nutritionnel_graisses' => 'FLOAT',
        'nutritionnel_acides_gras' => 'FLOAT',
        'nutritionnel_glucides' => 'FLOAT',
        'nutritionnel_sucres' => 'FLOAT',
        'nutritionnel_fibres' => 'FLOAT',
        'nutritionnel_proteines' => 'FLOAT',
        'nutritionnel_sel' => 'FLOAT',
        'nutritionnel_sodium' => 'FLOAT',
        'image_bouteille' => 'BLOB',
        'image_etiquette' => 'BLOB',
        'image_contreetiquette' => 'BLOB',
        'autres_infos' => 'TEXT',
        'authorization_key' => 'VARCHAR(100)',
        'date_creation' => 'VARCHAR(26)',
        'date_version' => 'VARCHAR(26)',
        'logo' => 'BOOL',
        'visites' => 'TEXT',
        'labels' => 'TEXT',
        'versions' => 'TEXT',
    ];

    public static function findByUserid($userid) {
		$class = get_called_class();
        $e = new $class();
        $qr = [];
        foreach ($e->mapper->find(array('user_id=?',$userid)) as $result) {
            $a = new $class();
            $a->mapper->load([self::$primaryKey.'=?', $result->{self::$primaryKey}]);
            $qr[] = $a;
        };
        return $qr;
	}

    public static function getListeCategoriesAdditif() {
        return [
            "Activateur de fermentation",
            "Agent de fermentation",
            "Agent stabilisateur",
            "Conservateur et antioxydant",
            "Correction de défauts",
            "Enzyme",
            "Gaz et gaz d'emballage",
            "Régulateur d'acidité",

        ];
    }

  public static function getFullListeIngredients() {
        return [
            "Raisins" => [],
            "Moût de raisin concentré" => [],
            "Liqueur de tirage et liqueur d'expédition" => [],
            "Acide tartrique - E334" => ['additif' => "Régulateur d'acidité"],
            "Acide malique - E296" => ['additif' => "Régulateur d'acidité"],
            "Acide lactique - E270" => ['additif' => "Régulateur d'acidité"],
            "Tartrate de potassium - E336" => ['additif' => "Régulateur d'acidité"],
            "Bicarbonate de potassium - E501" => ['additif' => "Régulateur d'acidité"],
            "Carbonate de calcium - E170" => ['additif' => "Régulateur d'acidité"],
            "Tartrate de calcium - E354" => ['additif' => "Régulateur d'acidité"],
            "Sulfate de calcium - E516" => ['additif' => "Régulateur d'acidité"],
            "Carbonate de potassium - E501" => ['additif' => "Régulateur d'acidité"],
            "Hydrogénotartrate de potassium - E336"=> ['additif' => "Agent stabilisateur"],
            "Tartrate de calcium - E354"=> ['additif' => "Agent stabilisateur"],
            "Acide citrique - E330"=> ['additif' => "Agent stabilisateur"],
            "Tanins"=> ['additif' => "Agent stabilisateur"],
            "Ferrocyanure de potassium - E536"=> ['additif' => "Agent stabilisateur"],
            "Phytate de calcium"=> ['additif' => "Agent stabilisateur"],
            "Acide métatartrique - E353"=> ['additif' => "Agent stabilisateur"],
            "Gomme arabique - E414"=> ['additif' => "Agent stabilisateur"],
            "Acide DL-tartrique"=> ['additif' => "Agent stabilisateur"],
            "Sel neutre de potassium"=> ['additif' => "Agent stabilisateur"],
            "Mannoprotéines de levures"=> ['additif' => "Agent stabilisateur"],
            "Carboxyméthylcellulose - E466"=> ['additif' => "Agent stabilisateur"],
            "Copolymères polyvinylimidazole/polyvinylpyrrolidone"=> ['additif' => "Agent stabilisateur"],
            "Polyaspartate de potassium - E456"=> ['additif' => "Agent stabilisateur"],
            "Dioxyde de soufre - E220" => ['additif' => "Conservateur et antioxydant"],
            "Bisulfite de potassium - E228" => ['additif' => "Conservateur et antioxydant"],
            "Métabisulfite de potassium - E224" => ['additif' => "Conservateur et antioxydant"],
            "Sorbate de potassium - E202" => ['additif' => "Conservateur et antioxydant"],
            "Lysozyme - E1105" => ['additif' => "Conservateur et antioxydant"],
            "Acide L-ascorbique - E300" => ['additif' => "Conservateur et antioxydant"],
            "Dicarbonate de diméthyle - E242" => ['additif' => "Conservateur et antioxydant"],
            "Argon - E938" => ['additif' => "Gaz et gaz d'emballage"],
            "Azote - E941" => ['additif' => "Gaz et gaz d'emballage"],
            "Dioxyde de carbone - E290" => ['additif' => "Gaz et gaz d'emballage"],
            "Oxygène gazeux - E948" => ['additif' => "Gaz et gaz d'emballage"],
            "Sulfites" => ["allergene" => true],
            "Anhydride sulfureux" => ["allergene" => true],
            "Oeuf" => ["allergene" => true],
            "Protéine de l'oeuf" => ["allergene" => true],
            "Produit de l'oeuf" => ["allergene" => true],
            "Lysozyme de l'oeuf" => ["allergene" => true],
            "Albumine de l'oeuf" => ["allergene" => true],
            "Lait" => ["allergene" => true],
            "Produits du lait" => ["allergene" => true],
            "Caséine du lait ou protéine du lait" => ["allergene" => true],
            "Résine de pin d'Alep" => [],
            "Lies fraîches" => [],
            "Caramel - E150" => [],
            "Isothiocyanate d'allyle" => [],
            "Levures inactivées" => [],
            "Charbons à usage oenologique" => [],
            "Fibres végétales sélectives" => [],
            "Cellulose microcristalline - E460" => ["additif" => "Activateur de fermentation"],
            "Hydrogénophosphate de diammonium - E342/CAS7783-28-0" => ["additif" => "Activateur de fermentation"],
            "Sulfate d'ammonium - E517/CAS7783-20-2" => ["additif" => "Activateur de fermentation"],
            "Bisulfite d'ammonium" => ["additif" => "Activateur de fermentation"],
            "Chlorhydrate de thiamine" => ["additif" => "Activateur de fermentation"],
            "Autolysats de levures" => ["additif" => "Activateur de fermentation"],
            "Levures inactivées" => ["additif" => "Activateur de fermentation"],
            "Levures inactivées ayant des niveaux garantis de glutathion" => ["additif" => "Activateur de fermentation"],
            "Gélatine alimentaire" => ["additif" => "Activateur de fermentation"],
            "Protéine de blé" => ["additif" => "Activateur de fermentation"],
            "Protéine issue de pois" => ["additif" => "Activateur de fermentation"],
            "Protéine issue de pommes de terre" => ["additif" => "Activateur de fermentation"],
            "Colle de poisson" => ["additif" => "Activateur de fermentation"],
            "Caséines" => ["additif" => "Activateur de fermentation"],
            "Caséinates de potassium" => ["additif" => "Activateur de fermentation"],
            "Ovalbumine" => ["additif" => "Activateur de fermentation"],
            "Bentonite - E558" => ["additif" => "Activateur de fermentation"],
            "Dioxyde de silicium - E551" => ["additif" => "Activateur de fermentation"],
            "Kaolin" => ["additif" => "Activateur de fermentation"],
            "Tanins" => ["additif" => "Activateur de fermentation"],
            "Chitosane dérivé d'Aspergillus niger" => ["additif" => "Activateur de fermentation"],
            "Chitine-glucane dérivé d'Aspergillus" => ["additif" => "Activateur de fermentation"],
            "Polyvinylpolypyrrolidone - E1202" => ["additif" => "Activateur de fermentation"],
            "Alginate de calcium - E404" => ["additif" => "Activateur de fermentation"],
            "Alginate de potassium - E402" => ["additif" => "Activateur de fermentation"],
            "Uréase" => ["additif" => "Enzyme"],
            "Pectines lyases" => ["additif" => "Enzyme"],
            "Pectine méthylestérase" => ["additif" => "Enzyme"],
            "Polygalacturonase" => ["additif" => "Enzyme"],
            "Hémicellulase" => ["additif" => "Enzyme"],
            "Cellulase" => ["additif" => "Enzyme"],
            "Bétaglucanase" => ["additif" => "Enzyme"],
            "Glycosidase" => ["additif" => "Enzyme"],
            "Levures de vinification" => ["additif" => "Agent de fermentation"],
            "Bactéries lactiques" => ["additif" => "Agent de fermentation"],
            "Sulfate de cuivre, pentahydraté" => ["additif" => "Correction de défauts"],
            "Citrate de cuivre" => ["additif" => "Correction de défauts"],
            "Chitosane dérivé d'Aspergillus niger" => ["additif" => "Correction de défauts"],
            "Chitine-glucane dérivé d'Aspergillus" => ["additif" => "Correction de défauts"],
            "dérivé d'Aspergillus niger" => ["additif" => "Correction de défauts"],
            "Levures inactivées" => ["additif" => "Correction de défauts"],
            "Résine de pin d'Alep" => [],
            "Lies fraîches" => [],
            "Caramel - E150" => [],
            "Isothiocyanate d'allyle" => [],
            "Levures inactivées" => [],
            "Hydrogénotartrate de potassium"=> ['additif' => "Agent stabilisateur"],
            "Tartrate de calcium"=> ['additif' => "Agent stabilisateur"],
            "E354"=> ['additif' => "Agent stabilisateur"],
            "Acide citrique"=> ['additif' => "Agent stabilisateur"],
            "E330"=> ['additif' => "Agent stabilisateur"],
            "Ferrocyanure de potassium"=> ['additif' => "Agent stabilisateur"],
            "E536"=> ['additif' => "Agent stabilisateur"],
            "Acide métatartrique"=> ['additif' => "Agent stabilisateur"],
            "E353"=> ['additif' => "Agent stabilisateur"],
            "Gomme arabique"=> ['additif' => "Agent stabilisateur"],
            "E414"=> ['additif' => "Agent stabilisateur"],
            "Carboxyméthylcellulose"=> ['additif' => "Agent stabilisateur"],
            "E466"=> ['additif' => "Agent stabilisateur"],
            "Polyaspartate de potassium"=> ['additif' => "Agent stabilisateur"],
            "E456"=> ['additif' => "Agent stabilisateur"],
            "Dioxyde de soufre" => ['additif' => "Conservateur et antioxydant"],
            "E220" => ['additif' => "Conservateur et antioxydant"],
            "Bisulfite de potassium" => ['additif' => "Conservateur et antioxydant"],
            "E228" => ['additif' => "Conservateur et antioxydant"],
            "Métabisulfite de potassium" => ['additif' => "Conservateur et antioxydant"],
            "E224" => ['additif' => "Conservateur et antioxydant"],
            "Sorbate de potassium" => ['additif' => "Conservateur et antioxydant"],
            "E202" => ['additif' => "Conservateur et antioxydant"],
            "Lysozyme" => ['additif' => "Conservateur et antioxydant"],
            "E1105" => ['additif' => "Conservateur et antioxydant"],
            "Acide L-ascorbique" => ['additif' => "Conservateur et antioxydant"],
            "E300" => ['additif' => "Conservateur et antioxydant"],
            "Dicarbonate de diméthyle" => ['additif' => "Conservateur et antioxydant"],
            "E242" => ['additif' => "Conservateur et antioxydant"],
            "Argon" => ['additif' => "Gaz et gaz d'emballage"],
            "E938" => ['additif' => "Gaz et gaz d'emballage"],
            "Azote" => ['additif' => "Gaz et gaz d'emballage"],
            "E941" => ['additif' => "Gaz et gaz d'emballage"],
            "Dioxyde de carbone" => ['additif' => "Gaz et gaz d'emballage"],
            "E290" => ['additif' => "Gaz et gaz d'emballage"],
            "Oxygène gazeux" => ['additif' => "Gaz et gaz d'emballage"],
            "E948" => ['additif' => "Gaz et gaz d'emballage"],
            "Cellulose microcristalline" => ["additif" => "Activateur de fermentation"],
            "E460" => ["additif" => "Activateur de fermentation"],
            "Hydrogénophosphate de diammonium" => ["additif" => "Activateur de fermentation"],
            "E342/CAS7783-28-0" => ["additif" => "Activateur de fermentation"],
            "Sulfate d'ammonium" => ["additif" => "Activateur de fermentation"],
            "E517/CAS7783-20-2" => ["additif" => "Activateur de fermentation"],
            "Bentonite" => ["additif" => "Activateur de fermentation"],
            "E558" => ["additif" => "Activateur de fermentation"],
            "Dioxyde de silicium" => ["additif" => "Activateur de fermentation"],
            "E551" => ["additif" => "Activateur de fermentation"],
            "Polyvinylpolypyrrolidone" => ["additif" => "Activateur de fermentation"],
            "E1202" => ["additif" => "Activateur de fermentation"],
            "Alginate de calcium" => ["additif" => "Activateur de fermentation"],
            "E404" => ["additif" => "Activateur de fermentation"],
            "Alginate de potassium" => ["additif" => "Activateur de fermentation"],
            "E402" => ["additif" => "Activateur de fermentation"],
            "Acide tartrique" => ['additif' => "Régulateur d'acidité"],
            "E334" => ['additif' => "Régulateur d'acidité"],
            "Acide malique" => ['additif' => "Régulateur d'acidité"],
            "E296" => ['additif' => "Régulateur d'acidité"],
            "Acide lactique" => ['additif' => "Régulateur d'acidité"],
            "E270" => ['additif' => "Régulateur d'acidité"],
            "Tartrate de potassium" => ['additif' => "Régulateur d'acidité"],
            "E336" => ['additif' => "Régulateur d'acidité"],
            "Bicarbonate de potassium" => ['additif' => "Régulateur d'acidité"],
            "E501" => ['additif' => "Régulateur d'acidité"],
            "Carbonate de calcium" => ['additif' => "Régulateur d'acidité"],
            "E170" => ['additif' => "Régulateur d'acidité"],
            "Tartrate de calcium" => ['additif' => "Régulateur d'acidité"],
            "E354" => ['additif' => "Régulateur d'acidité"],
            "Sulfate de calcium" => ['additif' => "Régulateur d'acidité"],
            "E516" => ['additif' => "Régulateur d'acidité"],
            "Carbonate de potassium" => ['additif' => "Régulateur d'acidité"],
            "E501" => ['additif' => "Régulateur d'acidité"],
        ];
  }

	public function save() {
		if (!isset($this->authorization_key) || $this->authorization_key) {
			$this->authorization_key = sha1(implode(',',$this->toArray()).rand());
		}
		if (!$this->getId()) {
			$this->setId(self::generateId());
		}
		$this->date_version = date('c');
		if (!$this->date_creation) {
			$this->date_creation = $this->date_version;
		}

    $this->saveVersion();

		return $this->mapper->save();
	}

  private function saveVersion() {
    if (!$this->getVisites()) return;
    if (!$this->changed()) return;
    if (!$this->getId()) return;

    $initial = (self::findById($this->getId()))->toArray();
    $current = $this->toArray();

    foreach (self::$versionning_ignore_fields as $field) {
      if (isset($initial[$field])) unset($initial[$field]);
      if (isset($current[$field])) unset($current[$field]);
    }

    if (array_diff_assoc($current, $initial)) {
      $this->addVersion($current);
    }
  }

	public static function generateId() {
		for($x = 0 ; $x < 10 ; $x++) {
			$id = '10';
			for($i = strlen($id) ; $i < 8 ; $i++) {
				$id .= substr(self::$CHARID, rand(0, strlen(self::$CHARID)), 1);
			}
			$qr = self::findById($id);
			if (! $qr) {
				return $id;
			}
		}
		throw new Exception('no free id found');
	}

	public function getQRCodeContent($format, $urlbase, $config) {
        return Exporter::getInstance()->getQRCodeContent(
            $urlbase.'/'.$this->getId(),
            $format,
            ($this->logo) ? $config['logo'] : false,
            [$this->nutritionnel_energie_kcal, $this->nutritionnel_energie_kj]
        );
  }

  protected function getJsonValueField($field) {
    $value = $this->get($field);
    if ($value) {
      return json_decode($value, true);
    }
    return [];
  }

  public function getVisites() {
    return $this->getJsonValueField('visites');
  }

  public function getLabels() {
    return $this->getJsonValueField('labels');
  }

  public function getVersions() {
    return $this->getJsonValueField('versions');
  }

  public function addVisite(array $infos) {
    $visites = $this->getVisites();
    $visites[] = $infos;
    $this->visites = json_encode($visites);
  }

  private function addVersion(array $qrcode, $datetime = null) {
    $versions = $this->getVersions();
    $key = date(self::VERSION_KEY_DATEFORMAT);
    if ($datetime) {
      if ($d = DateTime::createFromFormat(self::VERSION_KEY_DATEFORMAT, $datetime)) {
        if ($d->format(self::VERSION_KEY_DATEFORMAT) === $datetime) {
          $key = $datetime;
        }
      }
    }
    $versions[$key] = $qrcode;
    krsort($versions);
    $this->versions = json_encode($versions);
  }
}

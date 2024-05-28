<?php

use app\exporters\Exporter;

require_once('Mapper.php');

class QRCode extends Mapper
{
    public static $CHARID = 'azertyuiopqsdfghjklmwxcvbn'.
                            'AZERTYUIOPQSDFGHJKLMWXCVBN'.
                            '0123456789';
    public static $LABELS = ["HVE", "Demeter", "Biodyvin"];

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
  ];

	 public static function getFieldsAndType() {
		 $fields['id'] = 'VARCHAR(255) PRIMARY KEY';
		 $fields['user_id'] = 'VARCHAR(255)';
     $fields['domaine_nom'] = 'VARCHAR(255)';
		 $fields['adresse_domaine'] = 'VARCHAR(255)';
		 $fields['appellation'] = 'VARCHAR(255)';
		 $fields['couleur'] = 'VARCHAR(255)';
		 $fields['cuvee_nom'] = 'VARCHAR(255)';
		 $fields['alcool_degre'] = 'FLOAT';
		 $fields['centilisation'] = 'FLOAT';
		 $fields['millesime'] = 'VARCHAR(255)';
		 $fields['lot'] = 'VARCHAR(255)';
 		 $fields['ingredients'] = 'TEXT';
		 $fields['nutritionnel_energie_kj'] = 'FLOAT';
		 $fields['nutritionnel_energie_kcal'] = 'FLOAT';
		 $fields['nutritionnel_graisses'] = 'FLOAT';
		 $fields['nutritionnel_acides_gras'] = 'FLOAT';
		 $fields['nutritionnel_glucides'] = 'FLOAT';
		 $fields['nutritionnel_sucres'] = 'FLOAT';
		 $fields['nutritionnel_fibres'] = 'FLOAT';
		 $fields['nutritionnel_proteines'] = 'FLOAT';
		 $fields['nutritionnel_sel'] = 'FLOAT';
		 $fields['nutritionnel_sodium'] = 'FLOAT';
		 $fields['image_bouteille'] = 'BLOB';
		 $fields['image_etiquette'] = 'BLOB';
		 $fields['image_contreetiquette'] = 'BLOB';
 		 $fields['autres_infos'] = 'TEXT';
		 $fields['authorization_key'] = 'VARCHAR(100)';
		 $fields['date_creation'] = 'VARCHAR(26)';
		 $fields['date_version'] = 'VARCHAR(26)';
     $fields['logo'] = 'BOOL';
     $fields['visites'] = 'TEXT';
     $fields['labels'] = 'TEXT';
		 return $fields;
 	}

    public static function findByUserid($userid) {
		$class = get_called_class();
        $e = new $class();
		return $e->mapper->find(array('user_id=?',$userid));
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
            _("Raisins") => [],
            _("Moût de raisin concentré") => [],
            _("Liqueur de tirage et liqueur d'expédition") => [],
            _("Acide tartrique - E334") => ['additif' => "Régulateur d'acidité"],
            _("Acide malique - E296") => ['additif' => "Régulateur d'acidité"],
            _("Acide lactique - E270") => ['additif' => "Régulateur d'acidité"],
            _("Tartrate de potassium - E336") => ['additif' => "Régulateur d'acidité"],
            _("Bicarbonate de potassium - E501") => ['additif' => "Régulateur d'acidité"],
            _("Carbonate de calcium - E170") => ['additif' => "Régulateur d'acidité"],
            _("Tartrate de calcium - E354") => ['additif' => "Régulateur d'acidité"],
            _("Sulfate de calcium - E516") => ['additif' => "Régulateur d'acidité"],
            _("Carbonate de potassium - E501") => ['additif' => "Régulateur d'acidité"],
            _("Hydrogénotartrate de potassium - E336") => ['additif' => "Agent stabilisateur"],
            _("Tartrate de calcium - E354") => ['additif' => "Agent stabilisateur"],
            _("Acide citrique - E330") => ['additif' => "Agent stabilisateur"],
            _("Tanins") => ['additif' => "Agent stabilisateur"],
            _("Ferrocyanure de potassium - E536") => ['additif' => "Agent stabilisateur"],
            _("Phytate de calcium")=> ['additif' => "Agent stabilisateur"],
            _("Acide métatartrique - E353")=> ['additif' => "Agent stabilisateur"],
            _("Gomme arabique - E414")=> ['additif' => "Agent stabilisateur"],
            _("Acide DL-tartrique")=> ['additif' => "Agent stabilisateur"],
            _("Sel neutre de potassium")=> ['additif' => "Agent stabilisateur"],
            _("Mannoprotéines de levures")=> ['additif' => "Agent stabilisateur"],
            _("Carboxyméthylcellulose - E466")=> ['additif' => "Agent stabilisateur"],
            _("Copolymères polyvinylimidazole/polyvinylpyrrolidone")=> ['additif' => "Agent stabilisateur"],
            _("Polyaspartate de potassium - E456")=> ['additif' => "Agent stabilisateur"],
            _("Dioxyde de soufre - E220") => ['additif' => "Conservateur et antioxydant"],
            _("Bisulfite de potassium - E228") => ['additif' => "Conservateur et antioxydant"],
            _("Métabisulfite de potassium - E224") => ['additif' => "Conservateur et antioxydant"],
            _("Sorbate de potassium - E202") => ['additif' => "Conservateur et antioxydant"],
            _("Lysozyme - E1105") => ['additif' => "Conservateur et antioxydant"],
            _("Acide L-ascorbique - E300") => ['additif' => "Conservateur et antioxydant"],
            _("Dicarbonate de diméthyle - E242") => ['additif' => "Conservateur et antioxydant"],
            _("Argon - E938") => ['additif' => "Gaz et gaz d'emballage"],
            _("Azote - E941") => ['additif' => "Gaz et gaz d'emballage"],
            _("Dioxyde de carbone - E290") => ['additif' => "Gaz et gaz d'emballage"],
            _("Oxygène gazeux - E948") => ['additif' => "Gaz et gaz d'emballage"],
            _("Sulfites") => ["allergene" => true],
            _("Anhydride sulfureux") => ["allergene" => true],
            _("Oeuf") => ["allergene" => true],
            _("Protéine de l'oeuf") => ["allergene" => true],
            _("Produit de l'oeuf") => ["allergene" => true],
            _("Lysozyme de l'oeuf") => ["allergene" => true],
            _("Albumine de l'oeuf") => ["allergene" => true],
            _("Lait") => ["allergene" => true],
            _("Produits du lait") => ["allergene" => true],
            _("Caséine du lait ou protéine du lait") => ["allergene" => true],
            _("Résine de pin d'Alep") => [],
            _("Lies fraîches") => [],
            _("Caramel - E150") => [],
            _("Isothiocyanate d'allyle") => [],
            _("Levures inactivées") => [],
            _("Charbons à usage oenologique") => [],
            _("Fibres végétales sélectives") => [],
            _("Cellulose microcristalline - E460") => ["additif" => "Activateur de fermentation"],
            _("Hydrogénophosphate de diammonium - E342/CAS7783-28-0") => ["additif" => "Activateur de fermentation"],
            _("Sulfate d'ammonium - E517/CAS7783-20-2") => ["additif" => "Activateur de fermentation"],
            _("Bisulfite d'ammonium") => ["additif" => "Activateur de fermentation"],
            _("Chlorhydrate de thiamine") => ["additif" => "Activateur de fermentation"],
            _("Autolysats de levures") => ["additif" => "Activateur de fermentation"],
            _("Levures inactivées") => ["additif" => "Activateur de fermentation"],
            _("Levures inactivées ayant des niveaux garantis de glutathion") => ["additif" => "Activateur de fermentation"],
            _("Gélatine alimentaire") => ["additif" => "Activateur de fermentation"],
            _("Protéine de blé") => ["additif" => "Activateur de fermentation"],
            _("Protéine issue de pois") => ["additif" => "Activateur de fermentation"],
            _("Protéine issue de pommes de terre") => ["additif" => "Activateur de fermentation"],
            _("Colle de poisson") => ["additif" => "Activateur de fermentation"],
            _("Caséines") => ["additif" => "Activateur de fermentation"],
            _("Caséinates de potassium") => ["additif" => "Activateur de fermentation"],
            _("Ovalbumine") => ["additif" => "Activateur de fermentation"],
            _("Bentonite - E558") => ["additif" => "Activateur de fermentation"],
            _("Dioxyde de silicium - E551") => ["additif" => "Activateur de fermentation"],
            _("Kaolin") => ["additif" => "Activateur de fermentation"],
            _("Tanins") => ["additif" => "Activateur de fermentation"],
            _("Chitosane dérivé d'Aspergillus niger") => ["additif" => "Activateur de fermentation"],
            _("Chitine-glucane dérivé d'Aspergillus") => ["additif" => "Activateur de fermentation"],
            _("Polyvinylpolypyrrolidone - E1202") => ["additif" => "Activateur de fermentation"],
            _("Alginate de calcium - E404") => ["additif" => "Activateur de fermentation"],
            _("Alginate de potassium - E402") => ["additif" => "Activateur de fermentation"],
            _("Uréase") => ["additif" => "Enzyme"],
            _("Pectines lyases") => ["additif" => "Enzyme"],
            _("Pectine méthylestérase") => ["additif" => "Enzyme"],
            _("Polygalacturonase") => ["additif" => "Enzyme"],
            _("Hémicellulase") => ["additif" => "Enzyme"],
            _("Cellulase") => ["additif" => "Enzyme"],
            _("Bétaglucanase") => ["additif" => "Enzyme"],
            _("Glycosidase") => ["additif" => "Enzyme"],
            _("Levures de vinification") => ["additif" => "Agent de fermentation"],
            _("Bactéries lactiques") => ["additif" => "Agent de fermentation"],
            _("Sulfate de cuivre, pentahydraté") => ["additif" => "Correction de défauts"],
            _("Citrate de cuivre") => ["additif" => "Correction de défauts"],
            _("Chitosane dérivé d'Aspergillus niger") => ["additif" => "Correction de défauts"],
            _("Chitine-glucane dérivé d'Aspergillus") => ["additif" => "Correction de défauts"],
            _("dérivé d'Aspergillus niger") => ["additif" => "Correction de défauts"],
            _("Levures inactivées") => ["additif" => "Correction de défauts"],
            _("Résine de pin d'Alep") => [],
            _("Lies fraîches") => [],
            _("Caramel - E150") => [],
            _("Isothiocyanate d'allyle") => [],
            _("Levures inactivées") => [],
            _("Hydrogénotartrate de potassium") => ['additif' => "Agent stabilisateur"],
            _("Tartrate de calcium") => ['additif' => "Agent stabilisateur"],
            _("E354") => ['additif' => "Agent stabilisateur"],
            _("Acide citrique") => ['additif' => "Agent stabilisateur"],
            _("E330") => ['additif' => "Agent stabilisateur"],
            _("Ferrocyanure de potassium") => ['additif' => "Agent stabilisateur"],
            _("E536") => ['additif' => "Agent stabilisateur"],
            _("Acide métatartrique") => ['additif' => "Agent stabilisateur"],
            _("E353") => ['additif' => "Agent stabilisateur"],
            _("Gomme arabique") => ['additif' => "Agent stabilisateur"],
            _("E414") => ['additif' => "Agent stabilisateur"],
            _("Carboxyméthylcellulose") => ['additif' => "Agent stabilisateur"],
            _("E466") => ['additif' => "Agent stabilisateur"],
            _("Polyaspartate de potassium") => ['additif' => "Agent stabilisateur"],
            _("E456") => ['additif' => "Agent stabilisateur"],
            _("Dioxyde de soufre") => ['additif' => "Conservateur et antioxydant"],
            _("E220") => ['additif' => "Conservateur et antioxydant"],
            _("Bisulfite de potassium") => ['additif' => "Conservateur et antioxydant"],
            _("E228") => ['additif' => "Conservateur et antioxydant"],
            _("Métabisulfite de potassium") => ['additif' => "Conservateur et antioxydant"],
            _("E224") => ['additif' => "Conservateur et antioxydant"],
            _("Sorbate de potassium") => ['additif' => "Conservateur et antioxydant"],
            _("E202") => ['additif' => "Conservateur et antioxydant"],
            _("Lysozyme") => ['additif' => "Conservateur et antioxydant"],
            _("E1105") => ['additif' => "Conservateur et antioxydant"],
            _("Acide L-ascorbique") => ['additif' => "Conservateur et antioxydant"],
            _("E300") => ['additif' => "Conservateur et antioxydant"],
            _("Dicarbonate de diméthyle") => ['additif' => "Conservateur et antioxydant"],
            _("E242") => ['additif' => "Conservateur et antioxydant"],
            _("Argon") => ['additif' => "Gaz et gaz d'emballage"],
            _("E938") => ['additif' => "Gaz et gaz d'emballage"],
            _("Azote") => ['additif' => "Gaz et gaz d'emballage"],
            _("E941") => ['additif' => "Gaz et gaz d'emballage"],
            _("Dioxyde de carbone") => ['additif' => "Gaz et gaz d'emballage"],
            _("E290") => ['additif' => "Gaz et gaz d'emballage"],
            _("Oxygène gazeux") => ['additif' => "Gaz et gaz d'emballage"],
            _("E948") => ['additif' => "Gaz et gaz d'emballage"],
            _("Cellulose microcristalline") => ["additif" => "Activateur de fermentation"],
            _("E460") => ["additif" => "Activateur de fermentation"],
            _("Hydrogénophosphate de diammonium") => ["additif" => "Activateur de fermentation"],
            _("E342/CAS7783-28-0") => ["additif" => "Activateur de fermentation"],
            _("Sulfate d'ammonium") => ["additif" => "Activateur de fermentation"],
            _("E517/CAS7783-20-2") => ["additif" => "Activateur de fermentation"],
            _("Bentonite") => ["additif" => "Activateur de fermentation"],
            _("E558") => ["additif" => "Activateur de fermentation"],
            _("Dioxyde de silicium") => ["additif" => "Activateur de fermentation"],
            _("E551") => ["additif" => "Activateur de fermentation"],
            _("Polyvinylpolypyrrolidone") => ["additif" => "Activateur de fermentation"],
            _("E1202") => ["additif" => "Activateur de fermentation"],
            _("Alginate de calcium") => ["additif" => "Activateur de fermentation"],
            _("E404") => ["additif" => "Activateur de fermentation"],
            _("Alginate de potassium") => ["additif" => "Activateur de fermentation"],
            _("E402") => ["additif" => "Activateur de fermentation"],
            _("Acide tartrique") => ['additif' => "Régulateur d'acidité"],
            _("E334") => ['additif' => "Régulateur d'acidité"],
            _("Acide malique") => ['additif' => "Régulateur d'acidité"],
            _("E296") => ['additif' => "Régulateur d'acidité"],
            _("Acide lactique") => ['additif' => "Régulateur d'acidité"],
            _("E270") => ['additif' => "Régulateur d'acidité"],
            _("Tartrate de potassium") => ['additif' => "Régulateur d'acidité"],
            _("E336") => ['additif' => "Régulateur d'acidité"],
            _("Bicarbonate de potassium") => ['additif' => "Régulateur d'acidité"],
            _("E501") => ['additif' => "Régulateur d'acidité"],
            _("Carbonate de calcium") => ['additif' => "Régulateur d'acidité"],
            _("E170") => ['additif' => "Régulateur d'acidité"],
            _("Tartrate de calcium") => ['additif' => "Régulateur d'acidité"],
            _("E354") => ['additif' => "Régulateur d'acidité"],
            _("Sulfate de calcium") => ['additif' => "Régulateur d'acidité"],
            _("E516") => ['additif' => "Régulateur d'acidité"],
            _("Carbonate de potassium") => ['additif' => "Régulateur d'acidité"],
            _("E501") => ['additif' => "Régulateur d'acidité"],
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

		return $this->mapper->save();
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

  public function getVisites() {
    $visites = $this->get('visites');
    if ($visites) {
      return json_decode($visites, true);
    }
    return [];
  }

  public function addVisite(array $infos) {
    $visites = $this->getVisites();
    $visites[] = $infos;
    $this->visites = json_encode($visites);
  }

  public function getLabels() {
    $labels = $this->get('labels');
    if ($labels) {
      return json_decode($labels, true);
    }
    return [];
  }
}

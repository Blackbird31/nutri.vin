<?php

require_once('MapperTable.class.php');

class QRCode extends MapperTable
{
	function save() {
		if (!isset($this->authorization_key) || $this->authorization_key) {
			$this->authorization_key = sha1(implode(',',$this->values()).rand());
		}
		if (!$this->id) {
			$this->id = self::generateId();
		}
		$this->date_version = date('c');
		if (!$this->date_creation) {
		    $this->date_creation = $this->date_version;
		}
		return parent::save();
	}

	static $copy_field_filter =  array(
		"domaine_nom" => 1,
		"cuvee_nom" => 1, "appellation" => 1,
		"couleur" => 1,  "millesime" => 1,
		"alcool_degre" => 1, "centilisation" => 1, "lot" => 1,
		"ingredients" => 1,
		"nutritionnel_energie_kj" => 1, "nutritionnel_energie_kcal" => 1,
		"nutritionnel_graisses" => 1, "nutritionnel_acides_gras" => 1,
		"nutritionnel_glucides" => 1, "nutritionnel_sucres" => 1,
		"nutritionnel_proteines" => 1,
		"nutritionnel_sel" => 1, "nutritionnel_sodium" => 1,
		"image_bouteille" => 1,
		"image_etiquette" => 1,
		"image_contreetiquette" => 1,
		"autres_infos" => 1,
		"authorization_key" => 1
     );

	 static function getFieldsAndType() {
		 $fields = parent::getFieldsAndType();

		 $fields['id'] = 'VARCHAR(255) PRIMARY KEY';
		 $fields['user_id'] = 'VARCHAR(255)';

		 $fields['domaine_nom'] = 'VARCHAR(255)';

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

		 return $fields;
 	}

	function getListeIngredients() {
		return preg_split('/[,\n\r]+/', $this->ingredients);
	}

    static function getFullListeIngredients() {
        return array(
            "Raisins",
            "Moût de raisin concentré",
            "Liqueur de tirage et liqueur d'expédition",
            "Acide tartrique - E334",
            "Acide malique - E296",
            "Acide lactique - E270",
            "Tartrate de potassium - E336",
            "Bicarbonate de potassium - E501",
            "Carbonate de calcium - E170",
            "Tartrate de calcium - E354",
            "Sulfate de calcium - E516",
            "Carbonate de potassium - E501",
            "Hydrogénotartrate de potassium - E336",
            "Tartrate de calcium - E354",
            "Acide citrique - E330",
            "Tanins",
            "Ferrocyanure de potassium - E536",
            "Phytate de calcium",
            "Acide métatartrique - E353",
            "Gomme arabique - E414",
            "Acide DL-tartrique",
            "Sel neutre de potassium",
            "Mannoprotéines de levures",
            "Carboxyméthylcellulose - E466",
            "Copolymères polyvinylimidazole/polyvinylpyrrolidone",
            "Polyaspartate de potassium - E456",
            "Dioxyde de soufre - E220",
            "Bisulfite de potassium - E228",
            "Métabisulfite de potassium - E224",
            "Sorbate de potassium - E202",
            "Lysozyme - E1105",
            "Acide L-ascorbique - E300",
            "Dicarbonate de diméthyle - E242",
            "Argon - E938",
            "Azote - E941",
            "Dioxyde de carbone - E290",
            "Oxygène gazeux - E948",
            "Sulfites",
            "Anhydride sulfureux",
            "Oeuf",
            "Protéine de l'oeuf",
            "Produit de l'oeuf",
            "Lysozyme de l'oeuf",
            "Albumine de l'oeuf",
            "Lait",
            "Produits du lait",
            "Caséine du lait ou protéine du lait",
            "Résine de pin d'Alep",
            "Lies fraîches",
            "Caramel - E150",
            "Isothiocyanate d'allyle",
            "Levures inactivées",
            "Charbons à usage oenologique",
            "Fibres végétales sélectives",
            "Cellulose microcristalline - E460",
            "Hydrogénophosphate de diammonium - E342/CAS7783-28-0",
            "Sulfate d'ammonium - E517/CAS7783-20-2",
            "Bisulfite d'ammonium",
            "Chlorhydrate de thiamine",
            "Autolysats de levures",
            "Levures inactivées",
            "Levures inactivées ayant des niveaux garantis de glutathion",
            "Gélatine alimentaire",
            "Protéine de blé",
            "Protéine issue de pois",
            "Protéine issue de pommes de terre",
            "Colle de poisson",
            "Caséines",
            "Caséinates de potassium",
            "Ovalbumine",
            "Bentonite - E558",
            "Dioxyde de silicium - E551",
            "Kaolin",
            "Tanins",
            "Chitosane dérivé d'Aspergillus niger",
            "Chitine-glucane dérivé d'Aspergillus",
            "Polyvinylpolypyrrolidone - E1202",
            "Alginate de calcium - E404",
            "Alginate de potassium - E402",
            "Enzymes",
            "Uréase",
            "Pectines lyases",
            "Pectine méthylestérase",
            "Polygalacturonase",
            "Hémicellulase",
            "Cellulase",
            "Bétaglucanase",
            "Glycosidase",
            "Levures de vinification",
            "Bactéries lactiques",
            "Sulfate de cuivre, pentahydraté",
            "Citrate de cuivre",
            "Chitosane dérivé d'Aspergillus niger",
            "Chitine-glucane dérivé d'Aspergillus",
            "dérivé d'Aspergillus niger",
            "Levures inactivées",
            "Résine de pin d'Alep",
            "Lies fraîches",
            "Caramel - E150",
            "Isothiocyanate d'allyle",
            "Levures inactivées",
            "Hydrogénotartrate de potassium",
            "E336",
            "Tartrate de calcium",
            "E354",
            "Acide citrique",
            "E330",
            "Ferrocyanure de potassium",
            "E536",
            "Acide métatartrique",
            "E353",
            "Gomme arabique",
            "E414",
            "Carboxyméthylcellulose",
            "E466",
            "Polyaspartate de potassium",
            "E456",
            "Dioxyde de soufre",
            "E220",
            "Bisulfite de potassium",
            "E228",
            "Métabisulfite de potassium",
            "E224",
            "Sorbate de potassium",
            "E202",
            "Lysozyme",
            "E1105",
            "Acide L-ascorbique",
            "E300",
            "Dicarbonate de diméthyle",
            "E242",
            "Argon",
            "E938",
            "Azote",
            "E941",
            "Dioxyde de carbone",
            "E290",
            "Oxygène gazeux",
            "E948",
            "Cellulose microcristalline",
            "E460",
            "Hydrogénophosphate de diammonium",
            "E342/CAS7783-28-0",
            "Sulfate d'ammonium",
            "E517/CAS7783-20-2",
            "Bentonite",
            "E558",
            "Dioxyde de silicium",
            "E551",
            "Polyvinylpolypyrrolidone",
            "E1202",
            "Alginate de calcium",
            "E404",
            "Alginate de potassium",
            "E402",
            "Acide tartrique",
            "E334",
            "Acide malique",
            "E296",
            "Acide lactique",
            "E270",
            "Tartrate de potassium",
            "E336",
            "Bicarbonate de potassium",
            "E501",
            "Carbonate de calcium",
            "E170",
            "Tartrate de calcium",
            "E354",
            "Sulfate de calcium",
            "E516",
            "Carbonate de potassium",
            "E501",
        );
    }

	static function insertExample($a = null) {
		$qr = new QRCode();
		$qr->save();
		return $qr;
	}

	static $CHARID = 'azertyuiopqsdfghjklmwxcvbn'.
	                 'AZERTYUIOPQSDFGHJKLMWXCVBN'.
					 '0123456789';
	static function generateId() {
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

	static function findByUserid($userid) {
		$class = get_called_class();
		$e = new $class();
		return $e->find(array('user_id=?',$userid));
	}

    public function export($format, $url)
    {
    }
}

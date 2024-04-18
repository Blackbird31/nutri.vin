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
		"cuvee_nom" => 1, "appellation" => 1, "couleur" => 1,
		"alcool_degre" => 1, "centilisation" => 1, "millesime" => 1,
		"ingredients" => 1,
		"nutritionnel_energie_kj" => 1, "nutritionnel_energie_kcal" => 1,
		"nutritionnel_graisses" => 1, "nutritionnel_acides_gras" => 1,
		"nutritionnel_glucides" => 1, "nutritionnel_sucres" => 1,
		"nutritionnel_proteines" => 1,
		"nutritionnel_sel" => 1, "nutritionnel_sodium" => 1,
		"etiquette" => 1,
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

 		 $fields['etiquette'] = 'BLOB';

		 $fields['authorization_key'] = 'VARCHAR(100)';
		 $fields['date_creation'] = 'VARCHAR(26)';
		 $fields['date_version'] = 'VARCHAR(26)';

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
			"Acide tartrique",
			"E 334",
			"Acide malique",
			"E 296",
			"Acide lactique",
			"E 270",
			"Tartrate de potassium",
			"E 336",
			"Bicarbonate de potassium",
			"E 501",
			"Carbonate de calcium",
			"E 170",
			"Tartrate de calcium",
			"E 354",
			"Sulfate de calcium",
			"E 516",
			"Carbonate de potassium",
			"E 501",
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

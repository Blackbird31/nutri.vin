<?php

require_once('MapperTable.class.php');

class QRCode extends MapperTable {

	function save() {
		if (!isset($this->authorization_key) || $this->authorization_key) {
			$this->authorization_key = sha1(implode(',',$this->values()).rand());
		}
		if (!$this->id) {
			$this->id = null;
		}
		return parent::save();
	}

	static $copy_field_filter =  array(
		   "domaine_nom" => 1,
		   "cuvee_nom" => 1, "appellation" => 1, "couleur" => 1,
		   "alcool_degre" => 1, "centilisation" => 1, "millesime" => 1,
		   "ingredients" => 1,
		   "nutritionnel_energie" => 1, "nutritionnel_matieres_grasses" => 1,
		   "etiquette" => 1,
		   "authorization_key" => 1
     );

	 static function getFieldsAndType() {
		 $fields = parent::getFieldsAndType();

		 $fields['id'] = 'INTEGER PRIMARY KEY AUTOINCREMENT';
		 $fields['user_id'] = 'VARCHAR(255)';

		 $fields['domaine_nom'] = 'VARCHAR(255)';

		 $fields['appellation'] = 'VARCHAR(255)';
		 $fields['couleur'] = 'VARCHAR(255)';
		 $fields['cuvee_nom'] = 'VARCHAR(255)';

		 $fields['alcool_degre'] = 'VARCHAR(255)';
		 $fields['centilisation'] = 'VARCHAR(255)';

		 $fields['millesime'] = 'VARCHAR(255)';
		 $fields['lot'] = 'VARCHAR(255)';

 		 $fields['ingredients'] = 'TEXT';

		 $fields['nutritionnel_energie'] = 'INTEGER';
		 $fields['nutritionnel_matieres_grasses'] = 'INTEGER';

 		 $fields['etiquette'] = 'BLOB';

		 $fields['authorization_key'] = 'VARCHAR(100)';
		 return $fields;
 	}

	static function insertExample($a = null) {
		$qr = new QRCode();
		$qr->save();
		return $qr;
	}

}

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
		   "nom" => 1, "appellation" => 1, "couleur" => 1,
		   "alcool_degre" => 1, "quantite" => 1, "millesime" => 1, "lot" => 1,
		   "ingredients" => 1, "nutritionnel" => 1
     );

	 static function getFieldsAndType() {
		 $fields = parent::getFieldsAndType();

		 $fields['id'] = 'INTEGER PRIMARY KEY AUTOINCREMENT';
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

		 return $fields;
 	}

	static function insertExample($a = null) {
		$qr = new QRCode();
		$qr->save();
		return $qr;
	}

}

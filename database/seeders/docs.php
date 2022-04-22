<?php


return
	array(
		array(
			'doc_category_id' => 1, //
			'slug' => 'process',
			'meta_description' => '{"fr":"Processus de prise en charge du lead ou prospect"}',
			'meta_title' => '{"fr":"Processus de prise en charge du lead ou prospect"}',
			'title' => '{"fr":"Processus de prise en charge du lead ou prospect"}',
			'lead' => '{"fr":"Par défaut, aucun utilisateur ne constitue de lead ou prospect. Il est enregistré dans l\'application par un compte, qui peut être actif ou pas. Il ne devient un prospect ou lead, que lorsqu\'une entrée est créée dans la table user_processes"}',
			'body' => '{"fr":"Screenshots et procédures"}',
			'admin_id' => 1
		),
		array(
			'doc_category_id' => 1, //
			'slug' => 'staff',
			'meta_description' => '{"fr":"Page de documentation sur la classe Staff"}',
			'meta_title' => '{"fr":"La classe Staff"}',
			'title' => '{"fr":"Staff (Staff::class)"}',
			'lead' => '{"fr":"Tout utilisateur enregistré doit être pris en charge par un collaborateur (Staff)."}',
			'body' => '{"fr":"La prise en charge de l\'utilisateur par un collaborateur est assignée à tout moment par un administrateur ou assistant."}',
			'admin_id' => 1
		),

		// PROSPECT MANAGEMENT
		array(
			'doc_category_id' => 3, //
			'slug' => 'user-to-lead-conversion',
			'meta_description' => '{"fr":"Conversion d\'un utilisateur en prospect"}',
			'meta_title' => '{"fr":"Conversion d\'un utilisateur en prospect"}',
			'title' => '{"fr":"Conversion d\'un utilisateur en prospect"}',
			'lead' => '{"fr":"Par défaut, les nouveaux utilisateurs (ceux qui s\'enregistrent par le biais du site ou sont créés par un administrateur ou un assistant), ne sont pas des prospects. Ils sont des utilisateurs inscrits, titulaires d\'un compte d\'utilisateur. Il faut les convertir en prospect (lead)."}',
			'body' => '{"fr":"Pour convertir un utilisateur en lead, vous devez trouver l\'utilisateur et cliquer sur le bouton \"Activer le suivi\"."}',
			'admin_id' => 1
		),
	);
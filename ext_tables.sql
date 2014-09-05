# noinspection SqlNoDataSourceInspection
CREATE TABLE tx_efblog_domain_model_post (
	uid INT(11) NOT NULL AUTO_INCREMENT,
	pid INT(11) DEFAULT '0' NOT NULL,
	
	title VARCHAR(255) DEFAULT '' NOT NULL,
	author INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	date INT(11) DEFAULT '0' NOT NULL,
	archive INT(11) DEFAULT '0' NOT NULL,
	content INT(11) DEFAULT '0' NOT NULL,
	tags VARCHAR(255) DEFAULT '' NOT NULL,
	allow_comments INT(11) DEFAULT '0' NOT NULL,
	teaser_image TEXT,
	teaser_description TEXT,
	teaser_link TEXT,
	teaser_link_title TEXT,
	teaser_options INT(11) DEFAULT '0' NOT NULL,
	views INT(11) DEFAULT '0' NOT NULL,
	categories INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	related_posts INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	comments INT(11) UNSIGNED DEFAULT '0' NOT NULL,

	tstamp INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	crdate INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	deleted TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
	hidden TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
	fe_group VARCHAR(100) DEFAULT '0' NOT NULL,

	t3ver_oid INT(11) DEFAULT '0' NOT NULL,
	t3ver_id INT(11) DEFAULT '0' NOT NULL,
	t3ver_wsid INT(11) DEFAULT '0' NOT NULL,
	t3ver_label VARCHAR(255) DEFAULT '' NOT NULL,
	t3ver_state TINYINT(4) DEFAULT '0' NOT NULL,
	t3ver_stage INT(11) DEFAULT '0' NOT NULL,
	t3ver_count INT(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp INT(11) DEFAULT '0' NOT NULL,
	t3ver_move_id INT(11) DEFAULT '0' NOT NULL,

	t3_origuid INT(11) DEFAULT '0' NOT NULL,
	sys_language_uid INT(11) DEFAULT '0' NOT NULL,
	l18n_parent INT(11) DEFAULT '0' NOT NULL,
	l18n_diffsource MEDIUMBLOB NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);



CREATE TABLE tt_content (
	tx_efblog_post_content_mm INT(11) DEFAULT '0' NOT NULL,

	KEY efblog (tx_efblog_post_content_mm,sorting)
);

CREATE TABLE tx_efblog_post_category_mm (
	uid_local INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	uid_foreign INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	tablenames VARCHAR(255) DEFAULT '' NOT NULL,
	sorting INT(11) UNSIGNED DEFAULT '0' NOT NULL,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

CREATE TABLE tx_efblog_post_post_mm (
	uid_local INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	uid_foreign INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	tablenames VARCHAR(255) DEFAULT '' NOT NULL,
	sorting INT(11) UNSIGNED DEFAULT '0' NOT NULL,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

CREATE TABLE tx_efblog_post_author_mm (
	uid_local INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	uid_foreign INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	tablenames VARCHAR(255) DEFAULT '' NOT NULL,
	sorting INT(11) UNSIGNED DEFAULT '0' NOT NULL,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

CREATE TABLE tx_efblog_domain_model_category (
	uid INT(11) NOT NULL AUTO_INCREMENT,
	pid INT(11) DEFAULT '0' NOT NULL,
	
	title VARCHAR(255) DEFAULT '' NOT NULL,
	description TEXT NOT NULL,
	image TEXT,
	parent_category INT(11) UNSIGNED DEFAULT '0',

	tstamp INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	crdate INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	deleted TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
	hidden TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,

	t3ver_oid INT(11) DEFAULT '0' NOT NULL,
	t3ver_id INT(11) DEFAULT '0' NOT NULL,
	t3ver_wsid INT(11) DEFAULT '0' NOT NULL,
	t3ver_label VARCHAR(255) DEFAULT '' NOT NULL,
	t3ver_state TINYINT(4) DEFAULT '0' NOT NULL,
	t3ver_stage INT(11) DEFAULT '0' NOT NULL,
	t3ver_count INT(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp INT(11) DEFAULT '0' NOT NULL,
	t3ver_move_id INT(11) DEFAULT '0' NOT NULL,

	t3_origuid INT(11) DEFAULT '0' NOT NULL,
	sys_language_uid INT(11) DEFAULT '0' NOT NULL,
	l18n_parent INT(11) DEFAULT '0' NOT NULL,
	l18n_diffsource MEDIUMBLOB NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

CREATE TABLE tx_efblog_domain_model_comment (
	uid INT(11) NOT NULL AUTO_INCREMENT,
	pid INT(11) DEFAULT '0' NOT NULL,
	
	post INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	
	author VARCHAR(255) DEFAULT '' NOT NULL,
	email VARCHAR(255) DEFAULT '' NOT NULL,
	website VARCHAR(255) DEFAULT '' NOT NULL,
	location VARCHAR(255) DEFAULT '' NOT NULL,
	title TEXT NOT NULL,
	message TEXT NOT NULL,
	date INT(11) DEFAULT '0' NOT NULL,
	spampoints INT(11) DEFAULT '0' NOT NULL,
	spam_categories TEXT,
	ip TEXT NOT NULL,
	parent_comment INT(11) UNSIGNED DEFAULT '0',

	tstamp INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	crdate INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	deleted TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
	hidden TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,

	t3ver_oid INT(11) DEFAULT '0' NOT NULL,
	t3ver_id INT(11) DEFAULT '0' NOT NULL,
	t3ver_wsid INT(11) DEFAULT '0' NOT NULL,
	t3ver_label VARCHAR(255) DEFAULT '' NOT NULL,
	t3ver_state TINYINT(4) DEFAULT '0' NOT NULL,
	t3ver_stage INT(11) DEFAULT '0' NOT NULL,
	t3ver_count INT(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp INT(11) DEFAULT '0' NOT NULL,
	t3ver_move_id INT(11) DEFAULT '0' NOT NULL,

	t3_origuid INT(11) DEFAULT '0' NOT NULL,
	sys_language_uid INT(11) DEFAULT '0' NOT NULL,
	l18n_parent INT(11) DEFAULT '0' NOT NULL,
	l18n_diffsource MEDIUMBLOB NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

CREATE TABLE fe_users (
	tx_efblog_profile_page INT(11) UNSIGNED DEFAULT '0' NOT NULL
);
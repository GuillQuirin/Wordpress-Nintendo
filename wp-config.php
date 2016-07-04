<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'wordpress');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'root');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N'y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '_[mKEVp{lK)jlGT:gN)%Ow8XtwfQ:0?(#7~6)79o`F dQ9R?Fkb;tJtK&s,szlV|');
define('SECURE_AUTH_KEY',  '4~|C#tw>I3G&3.f,]Xi~?udwAUjL]@As,]k#,[C!vg`#SP`Um6kiy[@[u4q2#g*f');
define('LOGGED_IN_KEY',    '|[p+fSv|L-)|<b5]}l}L%:|z&{NfXr;-_g$:LU8f1jo2|1srT!$XM!u3>OTfkj>6');
define('NONCE_KEY',        'o3(ev72mHIgZM*{-;IZB*sgH`l8WJkvN%gup(|fJ9G;m]/q<WHe.u[@i[Kp]~oZ=');
define('AUTH_SALT',        'Y:Jr2HJY-V-DH.;#=T=HtpG03t3^~/N8r>U (U4G?HbbH(v6-47O/_Q4xX0668Kj');
define('SECURE_AUTH_SALT', '&!9>f)C2;vd+.@m<hgmuCUh [7 )^6iFALH]({n6a}V1@%7<wKp1xWrUft`[?WZQ');
define('LOGGED_IN_SALT',   'j~30/vR)uzc|PvR0~a_G2|(-fP0N*FG.l3!upV.i&6?Sd#v1(7NXS}Ihw}/F*9Fz');
define('NONCE_SALT',       'a}?<mu=v)Xf:rz8u:GUkm2kL=1@$Xa$}.{5No-|Sd~2u @ONPn(Id;:%+H85sDyq');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d'information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 * 
 * @link https://codex.wordpress.org/Debugging_in_WordPress 
 */
define('WP_DEBUG', false);

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'ciee_wordpress');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** Nome do host do MySQL */
define('DB_HOST', '127.0.0.1');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'hux+7+sL%E5~`Am!R.Q3dwA)65[|)Q9ON<_^41J~l}cRF9nqjhtE&fdb33)N$IEO');
define('SECURE_AUTH_KEY',  'JtLmw=trmj=l#(~KyAi,HrRR:SFr1>wlQo%]cjhHB@XxDwAH@Ae,4y.NeFxnRsot');
define('LOGGED_IN_KEY',    'dJWari$[_Z,,-vcC%,ea4Nz,KGC$QH*rwzgK%R6dPJTd0rp=mg:ZT j@_&IP=i>L');
define('NONCE_KEY',        '%{5@2HWh/aea,sF6gJx;#l`LiPUvi/K;zLIv,+Z8Nrutb:T7/fl2/4dg~qe?vA0n');
define('AUTH_SALT',        '`[F3glm3qa%;KWVtoNd]TB`o1<RFV9uSwW[b*A7^2A[!o1b-?S],?yi#?G_PZ2m+');
define('SECURE_AUTH_SALT', ',3#y$$g_>-AQFQR-Y2mz8XnZ-Ohn0N8x~]*F)x|HN.:_1}tKJS:2:-7@Ih&LFMZ0');
define('LOGGED_IN_SALT',   '@fc?NjsM9R=sJ0LC*71=ED[c )5!ZklSv[5[f kUj4CwXtz%Sydm<4N>/602=%3;');
define('NONCE_SALT',       ')nl5[i3SatRVL7St e} LEapuq_M>-`zJ8I3$M()A>oeo$WG;G2b~77xU?p&hBj$');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');

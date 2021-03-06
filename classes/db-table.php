<?php namespace BEA\Find_Media;

class DB_Table {

	use Singleton;

	/** @var object Database object (usually $GLOBALS['wpdb']) */
	public $db = false;

	public $db_version = 20171201;

	public $db_version_key = 'bea_wpdb_find_media_version';

	protected function init() {
		$this->add_table_to_db_object();

		// Check if DB needs upgrading
		add_action( 'admin_init', [ $this, 'upgrade_database' ] );
	}

	public function get_table_name() {
		return $this->db->bea_find_media ?? false;
	}

	public function add_table_to_db_object() {
		if ( ! empty( $this->get_table_name() ) ) {
			return;
		}

		// Setup plugin
		$this->db                     = $GLOBALS['wpdb'];
		$this->db->bea_find_media     = $this->db->base_prefix . 'bea_find_media';
		$this->db->ms_global_tables[] = 'bea_find_media';
	}

	public function upgrade_database( $old_version = 0 ) {
		// Get current version
		$old_version = get_network_option( - 1, $this->db_version_key );

		// Bail if no upgrade needed
		if ( version_compare( (int) $old_version, $this->db_version, '>=' ) ) {
			return;
		}

		// Check for `dbDelta`
		if ( ! function_exists( 'dbDelta' ) ) {
			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		}

		// Bail if upgrading global tables is not allowed
		if ( ! wp_should_upgrade_global_tables() ) {
			return;
		}

		if ( ! $this->table_exists() ) {
			// First activation
			$this->create_table();
		} elseif ( version_compare( (int) $old_version, 201609100001, '<=' ) ) {
			/**
			 * Update database structure from 1.0.1 to 2.0.0
			 * TODO : for future use
			 */
		} else {
			// Other case without any action
			return;
		}

		// Update the DB version
		update_network_option( - 1, $this->db_version_key, $this->db_version );
	}

	private function create_table() {
		$charset_collate = '';
		if ( ! empty( $this->db->charset ) ) {
			$charset_collate = "DEFAULT CHARACTER SET {$this->db->charset}";
		}

		if ( ! empty( $this->db->collate ) ) {
			$charset_collate .= " COLLATE {$this->db->collate}";
		}

		$sql   = [];
		$sql[] = "CREATE TABLE {$this->get_table_name()} (
			id bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			blog_id bigint(20) NOT NULL,
			type varchar(255) NOT NULL,
			media_id bigint(20) NOT NULL,
			object_id bigint(20) NOT NULL,
			object_type varchar(255) NOT NULL
		) {$charset_collate};";

		dbDelta( $sql );
	}

	public function table_exists() {
		$query       = "SHOW TABLES LIKE %s";
		$like        = $this->db->esc_like( $this->get_table_name() );
		$prepared    = $this->db->prepare( $query, $like );
		$table_exist = $this->db->get_var( $prepared );

		return ! empty( $table_exist );
	}
}

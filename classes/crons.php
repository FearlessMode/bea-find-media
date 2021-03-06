<?php namespace BEA\Find_Media;

class Crons {

	use Singleton;

	protected function init() {
		add_action( 'bea.find_media.cron.force_indexation', [ $this, 'cron_force_indexation' ] );
	}

	/**
	 * Schedule cron
	 *
	 * @since  1.0.1
	 * @author Maxime CULEA
	 */
	public static function schedule() {
		// Index all content with a cron
		wp_schedule_single_event( time() + ( 1 * MINUTE_IN_SECONDS ), 'bea.find_media.cron.force_indexation' );
	}

	/**
	 * Unschedule cron
	 *
	 * @since  1.0.1
	 * @author Maxime CULEA
	 */
	public static function unschedule() {
		wp_clear_scheduled_hook( 'bea.find_media.cron.force_indexation' );
	}

	/**
	 * Manage to index all contents for the current site with the cron
	 *
	 * @since  1.0.1
	 * @author Maxime CULEA
	 */
	public function cron_force_indexation() {
		$did_index = get_option( 'bea_find_media_index', false );
		if ( $did_index ) {
			return;
		}

		Main::force_indexation();
		update_option( 'bea_find_media_index', true );

		self::unschedule();
	}
}
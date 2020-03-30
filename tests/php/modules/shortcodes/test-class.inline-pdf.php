<?php
/**
 * Unit test for Inline PDF embeds.
 *
 * @package Jetpack
 * @since   8.4
 */
class WP_Test_Jetpack_Shortcodes_Inline_Pdfs extends WP_UnitTestCase {

	/**
	 * Unit test for Inline PDF embeds.
	 *
	 * @author lancewillett
	 * @covers ::jetpack_inline_pdf_embed_handler
	 * @since  8.4
	 */
	public function test_shortcodes_inline_pdf() {
		global $post;

		$url  = 'https://jetpackme.files.wordpress.com/2017/08/jetpack-tips-for-hosts.pdf';
		$post = $this->factory()->post->create_and_get( array( 'post_content' => $url ) );

		setup_postdata( $post );

		// Test HTML version.
		ob_start();
		the_content();
		$actual = ob_get_clean();

		wp_reset_postdata();

		$this->assertContains(
			sprintf(
				'<p><object data="%1$s" type="application/pdf" width="100%%" height="800"><p><a href="%1$s">%1$s</a></p></object></p>' . "\n",
				$url
			),
			$actual
		);
	}
}
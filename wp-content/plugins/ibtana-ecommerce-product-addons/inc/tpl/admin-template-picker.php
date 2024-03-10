<style>

	.iepa-lightbox {
		position: fixed;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		background: #fff;
		border: 1px solid #aaa;
		padding: 2.5em;
		display: none;
		z-index: 99999;
		max-width: 80vw;
		max-height: 80vh;
		overflow: auto;
		box-shadow: 0 0 0 9999px rgba(0,0,0,0.7);
	}

	.iepa-lightbox:target {
		display: block;
	}

	.iepa-lightbox h3 {
		margin-top: 0;
		margin-bottom: 2rem;
	}

	.iepa-lightbox .button {
		vertical-align: middle;
	}

	.iepa-templates {
		display: flex;
		flex-wrap: wrap;
		margin-right: -.7em;
	}

	.iepa-templates > a.button.button-primary { /*Needs higher specificity*/
		margin: .7em .7em 0 0;
		flex: 1;
	}

	.iepa-options {
		display: flex;
		justify-content: space-between;
		/* margin: 1em 0; */
	}
	.iepa-option {
		padding: 1em 0;
		flex: 0 0 30%;
		display: flex;
		flex-direction: column;
	}
	.iepa-option > :first-child,
	.iepa-option-2x > :first-child{
		margin-top: 0;
	}
	.iepa-option-2x {
		padding: calc( 1em - 1px ) 1em;
		/* background: rgba( 0, 0, 0, 0.2 ); */
		flex: 0 0 100%;
		box-sizing: border-box;
		display: grid;
	}

	.iepa-option > :last-child {
		margin-top: auto;
		text-align: center;
		width: 50%;
		justify-self: center;
	}
	.iepa-lb-footer {
		margin: 2.5em 0 0;
		text-align: right;
	}
</style>
<div id="iepa-enable-dialog" class="iepa-lightbox">
	<!-- <h3>Save the product!</h3> -->

	<div class="iepa-options">

		<div class="iepa-option iepa-option-2x">
			<h4>Save the product first!</h4>
			<p>You need to save the product first in order to use Block Editor. You can save as a draft with just a title if you want to make other changes later.</p>
			<a class="button button-primary" href="#">Yes, I'll save the product first</a>
		</div>

	</div>

	<!-- <footer class="iepa-lb-footer">Or <a href="#">Continue using default editor</a></footer> -->
</div>
<script type="text/javascript">
(function( $ ) {
  var all = document.querySelectorAll( '#iepa-enable-dialog a' );
  for (var i = 0; i < all.length; i++) {
    all[i].onclick = function( e ) {
      document.querySelector( '#iepa-enable-dialog' ).style.display = 'none';
    }
  }

	$(document).click(function(event) {
		if (!$(event.target).closest("#iepa-enable-dialog").length) {
			$( "#iepa-enable-dialog" ).hide();
		}
	});
})( jQuery );

</script>

<header class="header">
  <?php var_dump($viewmodel); ?>
  <div class="container">
    <h1 class="page-header">
      Bootstrap Cards<br />
      <small>Based on <a href="http://dev.theinstitutes.org/about-us/contact-us">Bootstrap 4</a></small>
    </h1>
  </div>
</header>

<div class="primary">
  <div class="container">

    <div class="row">
      <div class="col-sm-4">
        <h2>Example</h2>
        <p>Cards are built with as little markup and styles as possible, but still manage to deliver a ton of control and customization. Built with flexbox, they offer easy alignment and mix well with other Bootstrap components.</p>
        <p>This is an example of a basic card with mixed content and a fixed width. Cards have no fixed width to start, so they’ll naturally fill the full width of its parent element. This is easily customized with our various sizing options.</p>
      </div>
      <!-- /.col -->
      <div class="col-sm-8">
        <div class="card">
          <img class="card-img-top img-responsive" src="http://placehold.it/800x400" alt="Card image cap">
          <div class="card-block">
            <h4 class="card-title">Card title</h4>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <hr />

    <h2>Content Types</h2>
    <p>Cards support a wide variety of content, including images, text, list groups, links, and more. Mix and match multiple content types to create the card you need.</p>

    <hr />

    <div class="row">
      <div class="col-sm-4">
        <h3>Blocks</h3>
        <p>The building block of the card is the <code>.card-block</code>. Use it whenever you need a padded section within a card.</p>
      </div>
      <!-- /.col-sm-6 -->
      <div class="col-sm-8">
        <div class="card">
          <div class="card-block">
            This is some text within a card block.
          </div>
        </div>
      </div>
    </div>

    <hr />

    <div class="row">
      <div class="col-sm-4">
        <h3>Titles, text, and links</h3>
        <p>Card titles are used by adding <code>.card-title</code> to a <code>&lt;h*&gt;</code> tag. In the same way, links are added and placed next to each other by adding <code>.card-link</code> to a <code>&lt;a&gt;</code> tag.</p>
        <p>Subtitles are used by adding a <code>.card-subtitle</code> to a <code>&lt;h*&gt;</code> tag. If the <code>.card-title</code> and the <code>.card-subtitle</code> items are placed in a <code>.card-block</code> item, the card title and subtitle are
          aligned nicely.</p>
      </div>
      <!-- /.col-sm-6 -->
      <div class="col-sm-8">
        <div class="card">
          <div class="card-block">
            <h4 class="card-title">Card title</h4>
            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
          </div>
        </div>
      </div>
    </div>

    <hr />
    
    <div class="row">
      <div class="col-sm-4">
        <h3>Images</h3>
        <p><code>.card-img-top</code> places an image to the top of the card. With <code>.card-text</code>, text can be added to the card. Text within <code>.card-text</code> can also be styled with the standard HTML tags.</p>
      </div>
      <!-- /.col-sm-6 -->
      <div class="col-sm-8">
        <div class="card">
          <img class="card-img-top img-responsive" src="http://placehold.it/800x400" alt="Card image cap">
          <div class="card-block">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
        </div>
      </div>
    </div>

    <hr />
    
    <div class="row">
      <div class="col-sm-4">
        <h3>List groups</h3>
        <p>Create lists of content in a card with a flush list group.</p>
      </div>
      <!-- /.col-sm-6 -->
      <div class="col-sm-8">
        <div class="card">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Cras justo odio</li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Vestibulum at eros</li>
          </ul>
        </div>
      </div>
    </div>

    <hr />

    <div class="row">
      <div class="col-sm-4">
        <h3>Kitchen Sink</h3>
        <p>Mix and match multiple content types to create the card you need, or throw everything in there. Shown below are image styles, blocks, text styles, and a list group—all wrapped in a fixed-width card.</p>
      </div>
      <!-- /.col-sm-6 -->
      <div class="col-sm-8">
        <div class="card" style="width: 40rem;">
          <img class="card-img-top img-responsive" src="http://placehold.it/800x400" alt="Card image cap">
          <div class="card-block">
            <h4 class="card-title">Card title</h4>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Cras justo odio</li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Vestibulum at eros</li>
          </ul>
          <div class="card-block">
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
          </div>
        </div>
      </div>
    </div>

    <hr />
    
    <div class="row">
      <div class="col-sm-4">
        <h3>Header and footer</h3>
        <p>Add an optional header and/or footer within a card.</p>
      </div>
      <!-- /.col-sm-6 -->
      <div class="col-sm-8">
        <div class="card">
          <div class="card-header">
            Featured
          </div>
          <div class="card-block">
            <h4 class="card-title">Special title treatment</h4>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
    </div>
    
    <hr />
    
    <div class="row">
      <div class="col-sm-4">
        <p>Card headers can be styled by adding <code>.card-header</code> to <code>&lt;h*&gt;</code> elements.</p>
      </div>
      <div class="col-sm-8">
        <div class="card">
          <h3 class="card-header">Featured</h3>
          <div class="card-block">
            <h4 class="card-title">Special title treatment</h4>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
    </div>
    
    <hr />
    

    <hr />
    
    
    
    
    
    <h2>Sizing</h2>
    <p>Constrain the width of cards via custom CSS, our predefined grid classes, or with custom styles using our grid mixins.</p>

    <hr />

    <div class="row">
      <div class="col-sm-2">
        <p>Using the grid:</p>
      </div>
      <!-- /.col -->
      <div class="col-sm-6">
        <div class="card card-block">
          <h3 class="card-title">Special title treatment</h3>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
        <!-- /.card.card-block -->
      </div>
      <!-- /.col -->
      <div class="col-sm-4">
        <div class="card card-block">
          <h3 class="card-title">Special title treatment</h3>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
        <!-- /.card.card-block -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <hr />

    <div class="row">
      <div class="col-sm-2">
        <p>Using custom widths:</p>
      </div>
      <!-- /.col -->
      <div class="col-sm-10">
        <div class="card card-block" style="width: 30rem;">
          <h3 class="card-title">Special title treatment</h3>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
        <!-- /.card.card-block -->
        <div class="card card-block" style="width: 50rem;">
          <h3 class="card-title">Special title treatment</h3>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
        <!-- /.card.card-block -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <hr />

    <div class="row">
      <div class="col-sm-4">
        <h2>Text alignment</h2>
        <p>You can quickly change the text alignment of any card—in its entirety or specific parts—with our text align classes.</p>
      </div>
      <!-- /.col -->
      <div class="col-sm-8">
        <div class="card card-block">
          <h4 class="card-title">Special title treatment</h4>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
        <!-- /.card.card-block -->

        <div class="card card-block text-center">
          <h4 class="card-title">Special title treatment</h4>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
        <!-- /.card.card-block -->

        <div class="card card-block text-right">
          <h4 class="card-title">Special title treatment</h4>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
        <!-- /.card.card-block -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <hr />

  </div>
  <!-- /.container -->
</div>

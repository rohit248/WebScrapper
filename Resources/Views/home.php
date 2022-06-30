<?php
    require('Components/header.php');
?>


<main class="px-3">
    <div class="row justify-content-md-center">
        <div class="col-6">
            <h1>Your Own WebScrapper</h1>
            <p class="lead">
                This WebScrapper is a tool to scrap data of a url. Feel free to try out the tool by entring a url and hitting that Scrap Now Button.
            </p>
            <form action="/domain/submit" method="POST">
                <p class="lead">
                        <input type="url" class="form-control" id="url" name="url" aria-describedby="urlHelp" required>
                        <div id="urlHelp" class="form-text text-danger">
                        <?php
                            if (isset($error['url'])) {
                                echo $error["url"];
                            }
                        ?>
                        </div>
                    <button type="submit" href="#" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Scrap Now</button>
                </p>
            </form>
        </div>
    </div>
</main>

<?php
    require('Components/footer.php');
?>         
<h1>Ajouté un utilisateur</h1>

    <form action="/user/insert" method="POST" enctype="multipart/form-data">
        <div class="mx-5">
            <input type="hidden" name="method" value="INPUT/DATA">
            <input type="text" name="us-nom" placeholder="Nom" class="form-control">
            <input type="text" name="us-prenom" placeholder="Prenom" class="form-control">
            <input type="text" name="us-login" placeholder="Login" class="form-control">
            <input type="password" name="us-pass" placeholder="Mot de passe" class="form-control">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="us-avatar">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
            <div class="form-check">
                <input checked type="radio" name="us-genre" id="us-f" value="f" class="form-check-input">
                <label for="us-f">Feminin</label>
            </div>
            <div class="form-check">
                <input type="radio" name="us-genre" id="us-m" value="m" class="form-check-input">
                <label class="form-check-label" for="us-m">Masculin</label>
            </div>
            <input type="number" min="12" max="30" name="us-age" placeholder="Age" class="form-control">
            <input type="number" min="42" max="100" name="us-poid" placeholder="Poids" class="form-control">
            <input type="number" min="130" max="200" name="us-taille" placeholder="Taille" class="form-control">
        </div>
        <hr>
        <input type="submit" class="btn btn-primary" value="+ Ajouté">
    </form>

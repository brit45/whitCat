<h1 class="text-info bg-dark">Liste utilisateur :</h1>
<article>
    <div class="d-flex flex-wrap justify-content-center align-items-center">
        <?php $i = 1; ?>
        <?php foreach($user as $k): ?><div class="card" style="width: 18rem;">
                <div class="text-primary card-text">
                    <span class="text-dark">#<?= $i ?></span>
                </div>
                <div class="card-body">
                <?php if($k->picture): ?>
                    <div class="card-text"><img width="200px" src="data:image/jpg;base64,<?= $k->picture ?>" alt="<?=$k->nom?>"></div>
                <?php endif; ?>
                <div class="text-primary card-text">
                    Nom : <span class="text-dark"><?= $k->nom ?></span>
                </div>
                <div class="text-primary card-text">
                    Prenom : <span class="text-dark"><?= $k->prenom ?></span>
                </div>
                <div class="text-primary card-text">
                    Genre : <span class="text-dark"><?= ($k->genre == true)?'Masculin':'Feminin' ?></span>
                    <img src="" class="bi bi-trash" alt="">
                </div>
                
                
                
                <form class="suppr" action="/user/Delect" method="POST">
                    <input type="hidden" name="method" value="delete">
                    <input type="hidden" name="id-content" value="<?= $k->pass ?>">
                    <a href="<?= Router::RPatch('ViewEdit'); ?>/<?= $k->pass ?>" class="btn btn-primary">Voir la fiche</a>
                    <input type="submit" value="Supprimer" class="btn btn-danger  text-white">
                </form>
            </div>
            
        </div>
        <?php ++$i; ?>
        <?php endforeach; ?>
    </div>
    
</article>
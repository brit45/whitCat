
        <div>
            <table class="table table-secondary table-striped table-borderless">
                <thead><tr><th></th><th>INFO</th></tr></thead>
                <tr><td>Nom</td><td><?=$info[0]->nom?></td></tr>
                <tr><td>Prenom</td><td><?=$info[0]->prenom?></td></tr>
                <tr><td>Âge</td><td><?=$info[0]->age?></td></tr>
                <tr><td>Genre</td><td><?=($info[0]->genre==0)?'Feminin':'Masculin'?></td></tr>
                <tr><td>Taille</td><td><?=number_format(($info[0]->taille)/100,2)?>M</td></tr>
                <tr><td>Poids</td><td><?=$info[0]->poid?>Kg</td></tr>
            </table>
        </div>

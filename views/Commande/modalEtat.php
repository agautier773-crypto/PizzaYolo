<?php use App\Enum\Etat_commande; ?>
<div class="modal fade" id="modalEtat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> Mettre a jour l'état de la commande </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/UpdateEtat/" method="POST" id="formEtat">
                    <div class="mb-3">
                        <label for="etat" class="form-label">Changer l'état</label>
                        <select name="etat" id="etat" class="form-select">
                            <?php foreach (Etat_commande::cases() as $etat):?>
                                <?php if ($etat === $commande->etat) continue; ?>
                                <option value="<?=$etat->value ?>">
                                    <?= $etat->value ?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Confirmer</button>
            </div>
            </form>
        </div>
    </div>
</div>
    <script>
    document.getElementById('modalEtat').addEventListener('show.bs.modal', function(event) {
    const id = event.relatedTarget.getAttribute('data-id');
    document.getElementById('formEtat').action = `/UpdateEtat/${id}`;
    });
    </script>
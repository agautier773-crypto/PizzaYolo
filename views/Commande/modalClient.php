<div id="modal-client" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:999; align-items:center; justify-content:center;">
    <div style="background:var(--bg, #fff); padding:2rem; border-radius:0.75rem; min-width:320px;">
        <h3 style="margin:0 0 1rem 0;">Nouveau client</h3>

        <form id="form-nouveau-client" action="/createClient" method="POST">
            <div style="display:flex; flex-direction:column; gap:1rem;">

                <div>
                    <label for="nom">Nom <span>*</span></label>
                    <input type="text" id="nom" name="nom" class="form-select" placeholder="Dupont" required>
                </div>

                <div>
                    <label for="rue">Rue <span>*</span></label>
                    <input type="text" id="rue" name="rue" class="form-select" placeholder="" required>
                </div>

                <div>
                    <label for="ville">Email</label>
                    <input type="text" id="ville" name="ville" class="form-select" placeholder="" >
                </div>

                <div>
                    <label for="code_postal">Code Postal</label>
                    <input type="text" id="code_postal" name="code_postal" class="form-select" placeholder="XXXXX">
                </div>

                <div>
                    <label for="telephone">Telephone</label>
                    <input type="text" id="telephone" name="telephone" class="form-select" placeholder="0000000000">
                </div>

                <div style="display:flex; gap:0.5rem; justify-content:flex-end; margin-top:0.5rem;">
                    <button type="button" class="btn-add-client" onclick="closeModalClient()">Annuler</button>
                    <button type="submit" class="btn-add-client">Créer</button>
                </div>

            </div>
        </form>
    </div>
</div>
<style>
    .content { max-width: 520px; margin: 0 auto; padding: 2rem 1.5rem 0; }

    .page-header {
        margin-bottom: 1.5rem;
        padding-bottom: 1.25rem;
        border-bottom: 0.5px solid #e2e0db;
    }

    .page-title { font-size: 1rem; font-weight: 500; color: #1a1a18; }

    .card {
        background: #fff;
        border: 0.5px solid #e2e0db;
        border-radius: 10px;
        padding: 1.75rem;
    }

    .field { margin-bottom: 1.25rem; }

    label {
        display: block;
        font-size: 0.7rem;
        font-weight: 500;
        color: #9a9890;
        text-transform: uppercase;
        letter-spacing: .06em;
        margin-bottom: .4rem;
        font-family: 'DM Mono', monospace;
    }

    input[type=text] {
        width: 100%;
        background: #f5f4f1;
        border: 0.5px solid #e2e0db;
        border-radius: 6px;
        padding: .6rem .85rem;
        font-size: 0.875rem;
        color: #1a1a18;
        outline: none;
        transition: border-color .15s, background .15s;
        font-family: 'DM Sans', sans-serif;
    }

    input[type=text]:focus {
        border-color: #2c5f8a;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(44, 95, 138, .07);
    }

    input[type=text]::placeholder { color: #c0bdb8; }

    .divider { height: 0.5px; background: #e2e0db; margin: 1.5rem 0; }

    .footer { display: flex; justify-content: flex-end; gap: .5rem; }

    .btn {
        font-size: 0.78rem;
        font-weight: 500;
        padding: .4rem .9rem;
        border-radius: 6px;
        border: 0.5px solid transparent;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        transition: all .15s;
    }

    .btn-cancel { background: #f0efec; border-color: #e2e0db; color: #4a4a46; }
    .btn-cancel:hover { background: #e5e4e0; }

    .btn-submit { background: #2c5f8a; color: #fff; border-color: #2c5f8a; }
    .btn-submit:hover { background: #245078; }
    .qty-wrap {
        display: inline-flex; align-items: stretch;
        border: 1.5px solid var(--border); border-radius: 8px; overflow: hidden;
    }
    .qty-btn {
        width: 28px; background: #f8f9fb; border: none;
        font-size: 1rem; color: var(--text); cursor: pointer; transition: background .15s;
    }
    .qty-btn:hover { background: #edf2f7; }
    .qty-input {
        width: 38px; text-align: center; border: none;
        border-left: 1.5px solid var(--border); border-right: 1.5px solid var(--border);
        font-size: .88rem; font-weight: 600; background: #fff; color: var(--text); padding: .28rem 0;
        -moz-appearance: textfield;
    }
    .qty-input::-webkit-inner-spin-button,
    .qty-input::-webkit-outer-spin-button { -webkit-appearance: none; }
    .btn-add-row {
        background: none; border: 1.5px dashed var(--border); border-radius: var(--radius);
        color: var(--muted); font-family: 'Inter', sans-serif;
        font-size: .84rem; font-weight: 500;
        padding: .45rem 1rem; cursor: pointer; width: 100%; text-align: center;
        transition: border-color .18s, color .18s, background .18s;
    }
    .btn-add-row:hover { border-color: var(--red); color: var(--red); background: #fff8f8; }
    .btn-remove-row {
        background: none;
        border: none;
        color: #e74c3c;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 0 0.4rem;
        line-height: 1;
        align-self: center;
        transition: transform 0.1s;
    }

    .btn-remove-row:hover {
        transform: scale(1.3);
    }
    .btn-add-client {
        background: none;
        border: 1px solid var(--cyan, #0dcaf0);
        color: var(--cyan, #0dcaf0);
        padding: 0.4rem 0.8rem;
        border-radius: 0.5rem;
        cursor: pointer;
        white-space: nowrap;
        transition: background 0.15s, color 0.15s;
    }

    .btn-add-client:hover {
        background: var(--cyan, #0dcaf0);
        color: #fff;
    }
</style>
<?php
if(isset($commande->id_commande)){
    $action = "update";
    $actionUri = "/update/".$commande->id_commande;
}else{
    $action = "create";
    $actionUri = "/create";
}
?>

<div class="content">
    <div class="page-header">
        <span class="page-title">Nouvelle Commande</span>
    </div>
<!-- Form client -->
    <div class="card">
        <form action="<?=$actionUri?>" method="POST">
            <div class="ligne" style="margin-bottom:1rem;">
                <label for="client">Client</label>
                <div style="display:flex; gap:0.5rem; align-items:center;">
                    <select id="client" name="id_client" class="form-select" required>
                        <option disabled selected>Choisir un client</option>
                        <?php foreach ($clients as $c): ?>
                            <option value="<?= htmlspecialchars($c->id_client) ?>">
                                <?= htmlspecialchars($c->nom) ?>
                                / <?= htmlspecialchars($c->telephone) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="button" class="btn-add-client" onclick="openModalClient()">+ Nouveau client</button>
                </div>
            </div>

            <!-- form date -->
            <div class="ligne" style="margin-bottom:1rem;">
                <label for="nom">Date de la commande</label>
                <label for="date"></label><input type="datetime-local" id="date" name="date" placeholder="ex. Margherita" value="<?= $commande->date ?>">
            </div>
            <!-- Conteneur pour ajout pizza -->
            <div id="lignes-containers">
                <div class="ligne" data-index="0" style="margin-bottom:1rem;">
                    <div class="mb-4">
                        <label class="form-label">Pizza <span style="color:var(--cyan)">*</span></label>
                        <select name="lignes[0][id_pizza]" class="form-select" required>
                            <option disabled selected> Choisir une Pizza </option>
                            <?php foreach ($pizza as $p): ?>
                                <option
                                        value="<?= htmlspecialchars($p->id_pizza) ?>"
                                        data-price="<?= htmlspecialchars($p->prix) ?>"
                                >
                                    <?= htmlspecialchars($p->nom) ?>
                                     / <?= htmlspecialchars($p->prix)?>€
                                     / <?= htmlspecialchars($p->ingredients)?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="qty-wrap">
                        <button type="button" class="qty-btn" onclick="chgQty(this,-1)">−</button>
                        <input type="number" name="lignes[0][quantite]" class="qty-input" value="1" min="1" max="20" readonly/>
                        <button type="button" class="qty-btn" onclick="chgQty(this,1)">+</button>
                    </div>
                </div>
            </div>
            <button type="button" onclick="addLigne()" class="btn-add-row">
                + Ajouter une pizza
            </button>
            <!-- prix total commande -->
            <div class="field" style="margin-top:1rem;">
                <label>Total (€)</label>
                <input type="text" id="total" name="total" readonly value="0.00">
            </div>
            <div class="field">
                <label for="commentaires"> Commentaires </label>
                <input type="text" id="commentaires" name="commentaires">
            </div>
        </form>
        <?php require_once 'modalClient.php' ?>
    </div>
</div>

<script>
    //fonction appelé clique sur + ou -, additionne au delta et recalcul du montant
    function chgQty(btn, delta) {
        const input = btn.closest('.qty-wrap').querySelector('.qty-input');
        const v = parseInt(input.value || '1', 10);
        input.value = Math.min(20, Math.max(1, v + delta));
        updateTotal();
    }

    let ligneIndex = 1;

    // On copie la premiere ligne de pizza
    function addLigne() {
        const container = document.getElementById('lignes-containers');
        const first     = container.querySelector('.ligne');
        const clone     = first.cloneNode(true);

        const i = ligneIndex++;
        clone.setAttribute('data-index', i);

        // permet la construction d'un tableau pour le serveur
        clone.querySelectorAll('[name]').forEach(function (el) {
            el.name = el.name.replace(/\[\d+\]/, '[' + i + ']');
            if (el.tagName === 'SELECT') {
                el.selectedIndex = 0;
            }
            if (el.type === 'number') {
                el.value = 1;
            }

        });
        // Suppression d'une ligne pizza
        // recalcule le total quand on change la pizza
        clone.querySelector('select').addEventListener('change', updateTotal);

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.textContent = '✕';
        removeBtn.className = 'btn-remove-row';
        removeBtn.onclick = function () {
            clone.remove();
            updateTotal();
        };
        clone.appendChild(removeBtn);

        container.appendChild(clone);
        updateTotal();
    }

    //Mise a jour dynamique du prix total
    function updateTotal() {
        const lignes = document.querySelectorAll('#lignes-containers .ligne');
        let total = 0;

        lignes.forEach(function (ligne) {
            const select   = ligne.querySelector('select');
            const qtyInput = ligne.querySelector('.qty-input');

            if (!select || !qtyInput) return;

            //recupere le prix du produit
            const option = select.options[select.selectedIndex];
            const price  = parseFloat(option.getAttribute('data-price') || '0');
            const qty    = parseInt(qtyInput.value || '0', 10);

            total += price * qty;
        });

        document.getElementById('total').value = total.toFixed(2);
    }

    // attache le recalcul sur la première ligne
    document.addEventListener('DOMContentLoaded', function () {
        const firstSelect = document.querySelector('#lignes-container .ligne select');
        if (firstSelect) {
            firstSelect.addEventListener('change', updateTotal);
        }
        updateTotal();
    });

    //ouverture de la modal
    function openModalClient() {

        const modal = document.getElementById('modal-client');
        modal.style.display = 'flex';
    }

    //fermeture de la modal
    function closeModalClient() {
        const modal = document.getElementById('modal-client');
        modal.style.display = 'none';
    }
    // cette fonction permet de soumettre le formulaire client sans recharger la page et avoir accès direct au nouveau client
    //on bloque le rechargement du formulaire
    document.getElementById('form-nouveau-client').addEventListener('submit', function (e) {
        e.preventDefault();

        //recup les données envoyées
        const formData = new FormData(this);

        //Envoie des données au serveur
        fetch('/create', {
            method: 'POST',
            body: formData
        })
            // on recupere la reponse json du controller
            .then(response => response.json())
            .then(data => {
                // Crée et ajoute le nouveau client dans le select
                const select = document.getElementById('client');
                const option = document.createElement('option');
                option.value = data.id_client;
                option.textContent = data.nom;
                select.appendChild(option);

                // Sélectionne automatiquement le nouveau client
                select.value = data.id_client;

                closeModalClient();
            })
            .catch(err => {
                console.error('Erreur fetch:', err);
            });
    });

</script>
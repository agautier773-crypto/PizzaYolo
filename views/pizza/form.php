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
</style>
<?php
if(isset($pizza->id_pizza)){
    $action = "update";
    $actionUri = "/pizza/update/".$pizza->id_pizza;
}else{
    $action = "create";
    $actionUri = "/pizza/create";
}
?>

<div class="content">
    <div class="page-header">
        <span class="page-title">Nouvelle pizza</span>
    </div>

    <div class="card">
        <form action="<?=$actionUri?>" method="POST">
            <div class="field">
                <label for="nom">Nom de la pizza</label>
                <input type="text" id="nom" name="nom" placeholder="ex. Margherita" value="<?= $pizza->nom ?>">
            </div>
            <div class="field">
                <label for="ingredients">Ingrédients</label>
                <input type="text" id="ingredients" name="ingredients" placeholder="ex. tomate, mozzarella, basilic" value="<?= $pizza->ingredients?>">
            </div>
            <div class="field">
                <label for="prix">Prix (€)</label>
                <input type="text" id="prix" name="prix" placeholder="ex. 12.50" value="<?= $pizza->prix?>">
            </div>
            <div class="divider"></div>
            <div class="footer">
                <a href="/" class="btn btn-cancel">Annuler</a>
                <button type="submit" class="btn btn-submit">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
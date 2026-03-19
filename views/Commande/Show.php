<style>
    :root {
        --bg: #f5f4f1;
        --surface: #ffffff;
        --border: #e2e0db;
        --text-primary: #1a1a18;
        --text-muted: #7a7872;
        --accent: #2c5f8a;
        --accent-light: #e8f0f7;
        --danger: #c0392b;
        --danger-light: #fdf0ee;
        --warning: #b07d2a;
        --warning-light: #fdf6e8;
        --success: #2a7a4b;
        --success-light: #eaf5ef;
        --neutral: #4a4a46;
        --neutral-light: #f0efec;
    }

    body {
        background-color: var(--bg);
        font-family: 'DM Sans', sans-serif;
        color: var(--text-primary);
        min-height: 100vh;
    }

    .page-wrapper {
        max-width: 680px;
        margin: 0 auto;
        padding: 2.5rem 1.5rem 4rem;
    }

    /* Header */
    .page-header {
        margin-bottom: 2rem;
        padding-bottom: 1.25rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .page-title {
        font-size: 1.1rem;
        font-weight: 600;
        letter-spacing: -0.01em;
        margin: 0;
    }

    .order-id-badge {
        font-family: 'DM Mono', monospace;
        font-size: 0.82rem;
        font-weight: 500;
        background: var(--neutral-light);
        border: 1px solid var(--border);
        padding: 0.25rem 0.7rem;
        border-radius: 20px;
        color: var(--neutral);
    }

    /* Card */
    .detail-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 1.25rem;
    }

    .detail-card-header {
        background: var(--bg);
        border-bottom: 1px solid var(--border);
        padding: 0.7rem 1.1rem;
        font-family: 'DM Mono', monospace;
        font-size: 0.7rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--text-muted);
    }

    /* Lignes pizzas */
    .pizza-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.85rem 1.1rem;
        border-bottom: 1px solid var(--border);
        gap: 1rem;
    }

    .pizza-row:last-child {
        border-bottom: none;
    }

    .pizza-name {
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--text-primary);
        flex: 1;
    }

    .pizza-qty {
        font-family: 'DM Mono', monospace;
        font-size: 0.82rem;
        font-weight: 500;
        background: var(--accent-light);
        color: var(--accent);
        border: 1px solid #c0d8ee;
        padding: 0.25rem 0.75rem;
        border-radius: 5px;
        white-space: nowrap;
    }

    /* Commentaires */
    .comment-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
    }

    .comment-body {
        padding: 1rem 1.1rem;
        font-size: 0.9rem;
        color: var(--text-muted);
        line-height: 1.6;
        min-height: 80px;
    }
    .table-card tbody td {
        padding: 1rem 1.1rem;
        vertical-align: middle;
        border: none;
        font-size: 0.9rem;
    }
    /* Responsive */
    @media (max-width: 480px) {
        .pizza-name { font-size: 0.85rem; }
    }
    .badge-etat {
        font-family: 'DM Mono', monospace;
        font-size: 0.72rem;
        font-weight: 500;
        padding: 0.3rem 0.65rem;
        border-radius: 5px;
        letter-spacing: 0.03em;
        display: inline-block;
    }

    .badge-en-cours  { background: var(--warning-light); color: var(--warning); }
    .badge-validee   { background: var(--success-light);  color: var(--success); }
    .badge-annulee   { background: var(--danger-light);   color: var(--danger);  }
    .badge-livree    { background: var(--accent-light);   color: var(--accent);  }

</style>
<body>
<div class="page-wrapper">

    <div class="page-header">
        <h1 class="page-title">Détail de la commande</h1>
        <span class="order-id-badge"><?= $commande->id_commande ?></span>
    </div>

    <div class="detail-card">
        <div class="detail-card-header">Articles commandés</div>
        <table class="table table-borderless mb-0">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Ingrédients</th>
                <th>Quantité</th>
                <th>Etat</th>
            </tr>
            </thead>
            <tbody>

                <?php foreach ($commande->quantitePizza() as $pizza):?>
                <tr>
                    <td><?= $pizza->nom ?></td>
                    <td><?= $pizza->ingredients ?></td>
                    <td><span> <?= $pizza->quantite ?></span></td>
                    <td><span class="badge-etat <?= match($commande->etat){
                            'EN_PREPARATION' => 'badge-en-cours',
                            'LIVRER'                 => 'badge-validee',
                            'PRETE'                 => 'badge-en-cours',
                            'PAYE'                  => 'badge-livree',
                            default                   => 'badge-en-cours'
                        } ?>">
                        <?= $commande->etat ?>
                    </span>
                    </td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

</div>
</body>
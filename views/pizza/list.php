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
        max-width: 1080px;
        margin: 0 auto;
        padding: 1.5rem 1.5rem 4rem;
    }

    .page-header {
        margin-bottom: 2rem;
        padding-bottom: 1.25rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .page-title {
        font-size: 1.1rem;
        font-weight: 600;
        letter-spacing: -0.01em;
        color: var(--text-primary);
        margin: 0;
    }

    .page-count {
        font-family: 'DM Mono', monospace;
        font-size: 0.78rem;
        color: var(--text-muted);
        background: var(--neutral-light);
        padding: 0.2rem 0.6rem;
        border-radius: 20px;
    }

    .table-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
    }

    .table-card table { margin: 0; }

    .table-card thead tr {
        background: var(--bg);
        border-bottom: 1px solid var(--border);
    }

    .table-card thead th {
        font-family: 'DM Mono', monospace;
        font-size: 0.7rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--text-muted);
        padding: 0.8rem 1.1rem;
        border: none;
        white-space: nowrap;
    }

    .table-card tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background 0.15s ease;
    }

    .table-card tbody tr:last-child { border-bottom: none; }
    .table-card tbody tr:hover { background: #fafaf8; }

    .table-card tbody td {
        padding: 1rem 1.1rem;
        vertical-align: middle;
        border: none;
        font-size: 0.9rem;
    }

    .order-id {
        font-family: 'DM Mono', monospace;
        font-size: 0.82rem;
        font-weight: 500;
        color: var(--text-primary);
    }

    .badge-en-cours  { background: var(--warning-light); color: var(--warning); }
    .badge-validee   { background: var(--success-light);  color: var(--success); }
    .badge-annulee   { background: var(--danger-light);   color: var(--danger);  }
    .badge-livree    { background: var(--accent-light);   color: var(--accent);  }

    .actions-cell {
        display: flex;
        gap: 0.4rem;
        flex-wrap: wrap;
        align-items: center;
    }

    .btn-action {
        font-size: 0.78rem;
        font-weight: 500;
        padding: 0.3rem 0.7rem;
        border-radius: 5px;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all 0.15s ease;
        text-decoration: none;
        white-space: nowrap;
        display: inline-block;
    }

    .btn-show   { background: var(--neutral-light); border-color: var(--border);  color: var(--neutral); }
    .btn-show:hover   { background: #e5e4e0; color: var(--text-primary); }

    .btn-etat   { background: var(--warning-light); border-color: #e8d5a3; color: var(--warning); }
    .btn-etat:hover   { background: #f5e9c8; color: var(--warning); }

    .btn-update { background: var(--accent-light);  border-color: #c0d8ee; color: var(--accent);  }
    .btn-update:hover { background: #d4e6f4; color: var(--accent); }

    .btn-delete { background: var(--danger-light);  border-color: #f0c8c3; color: var(--danger);  }
    .btn-delete:hover { background: #f8dbd8; color: var(--danger); }

    @media (max-width: 640px) {
        .table-card thead th:nth-child(2),
        .table-card tbody td:nth-child(2) { display: none; }
    }
</style>

<div class="page-wrapper">

    <div class="page-header">
        <h1 class="page-title">Pizza sur la carte</h1>
        <span class="page-count"><?=count($pizza)?> </span>
    </div>

    <div class="table-card">
        <table class="table table-borderless mb-0">
            <thead>
            <tr>
                <th>Numéro</th>
                <th>Nom Pizza</th>
                <th>Ingrédients</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($pizza as $pizzas) :?>
                <tr>
                    <td><span class="order-id"><?= $pizzas->id_pizza ?></span></td>
                    <td> <?= $pizzas->nom ?></td>
                    <td><?= $pizzas->ingredients ?></td>
                    <td><?= $pizzas-> prix ?> €</td>
                    <td>
                        <div class="actions-cell">
                            <a href="/pizza/update/<?= $pizzas->id_pizza?>" class="btn-action btn-show">Update</a>
                            <a href="/pizza/delete/<?=$pizzas->id_pizza?>" class="btn-action btn-delete">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
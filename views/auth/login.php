<style>
    body {
        background-color: #f5f4f0;
        font-family: 'Helvetica Neue', Arial, sans-serif;
        color: #1a1a1a;
    }

    /* ── Card ── */
    .auth-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 3rem 1rem;
    }

    .auth-card {
        background: #ffffff;
        border-radius: 10px;
        border: 1px solid #e5e5e5;
        padding: 2.5rem 2.25rem;
        width: 100%;
        max-width: 420px;
    }

    .auth-card h5 {
        font-weight: 700;
        font-size: 1.05rem;
        margin-bottom: 1.75rem;
        letter-spacing: -0.2px;
    }

    /* ── Form controls ── */
    .form-label {
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        color: #888;
        font-weight: 600;
        margin-bottom: 0.35rem;
    }

    .form-control {
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 0.9rem;
        padding: 0.55rem 0.75rem;
        background-color: #fafafa;
        color: #1a1a1a;
        transition: border-color 0.15s;
    }
    .form-control:focus {
        border-color: #aaa;
        background-color: #fff;
        box-shadow: none;
    }

    /* ── Buttons ── */
    .btn-login {
        background-color: #1a1a1a;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-size: 0.875rem;
        padding: 0.55rem 1.25rem;
        width: 100%;
        margin-top: 0.5rem;
        transition: opacity 0.15s;
        cursor: pointer;
    }
    .btn-login:hover { opacity: 0.8; color: #fff; }

    .btn-outline-custom {
        background: transparent;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 0.875rem;
        color: #1a1a1a;
        padding: 0.55rem 1.25rem;
        width: 100%;
        margin-top: 0.5rem;
        transition: border-color 0.15s, background 0.15s;
        cursor: pointer;
    }
    .btn-outline-custom:hover {
        background-color: #f0efeb;
        border-color: #aaa;
    }

    .divider {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin: 1.25rem 0;
        color: #bbb;
        font-size: 0.8rem;
    }
    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e5e5e5;
    }

    .auth-footer {
        text-align: center;
        margin-top: 0.75rem;
        font-size: 0.82rem;
        color: #888;
    }
    .auth-footer a {
        color: #1a1a1a;
        text-decoration: underline;
        text-underline-offset: 2px;
    }
    .auth-footer a:hover { opacity: 0.6; }
</style>

<!-- Auth card -->
<div class="auth-wrapper">
    <form class="auth-card" action="/login" method="POST">
        <?php \App\Helpers\Csrf::field() ?>
        <h5>Se connecter</h5>

        <div class="mb-3">
            <label for="nom" class="form-label">Employé</label>
            <input type="text" id="nom" name="nom" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required autocomplete="current-password" />
        </div>

        <button type="submit" class="btn-login">Se connecter</button>
    </form>
</div>
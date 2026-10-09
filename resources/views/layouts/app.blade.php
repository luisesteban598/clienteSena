<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin SENA</title>

    {{-- Cargar Bootstrap para estilos del menú y otros componentes --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Mantengo un lenguaje visual propio para las tablas administrativas. */
        .management-page {
            max-width: 1180px;
            margin: 0 auto;
            padding: 2.5rem 1.25rem;
            color: #23261f;
        }
        .management-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .management-kicker {
            color: #2c7a00;
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }
        .management-header h1 {
            margin: .35rem 0 .3rem;
            font-size: 2rem;
            font-weight: 700;
        }
        .management-header p {
            margin: 0;
            color: #6b7280;
        }
        .management-primary-action {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .7rem 1rem;
            border-radius: 8px;
            background: #39a900;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
        }
        .management-primary-action:hover { background: #2c7a00; color: #fff; }
        .management-primary-action span { font-size: 1.2rem; line-height: 1; }
        .management-secondary-action {
            display: inline-flex;
            align-items: center;
            padding: .7rem 1rem;
            border: 1px solid #d8ded5;
            border-radius: 8px;
            color: #5b6157;
            font-weight: 600;
            text-decoration: none;
        }
        .management-secondary-action:hover { background: #f4f6f3; color: #23261f; }
        .management-card {
            overflow: hidden;
            border: 1px solid #e1e5de;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .06);
        }
        .management-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #e1e5de;
            color: #6b7280;
        }
        .management-toolbar strong { color: #23261f; font-size: 1.1rem; }
        .management-search {
            display: flex;
            align-items: center;
            gap: .4rem;
            min-width: 260px;
            padding: .45rem .7rem;
            border: 1px solid #d8ded5;
            border-radius: 7px;
            color: #6b7280;
        }
        .management-search input {
            width: 100%;
            border: 0;
            outline: 0;
            color: #23261f;
        }
        .management-table-wrap { overflow-x: auto; }
        .management-table { width: 100%; border-collapse: collapse; }
        .management-table th {
            padding: .85rem 1.25rem;
            background: #f4f6f3;
            color: #5b6157;
            font-size: .74rem;
            letter-spacing: .05em;
            text-align: left;
            text-transform: uppercase;
        }
        .management-table td {
            padding: 1rem 1.25rem;
            border-top: 1px solid #edf0eb;
            vertical-align: middle;
        }
        .management-table tbody tr { transition: background .15s ease; }
        .management-table tbody tr:hover { background: #fbfdf9; }
        .management-actions-heading { text-align: right !important; }
        .record-id { color: #6b7280; font-size: .85rem; font-weight: 600; }
        .management-actions { display: flex; justify-content: flex-end; gap: .5rem; }
        .management-actions form { margin: 0; }
        .table-action {
            display: inline-block;
            padding: .4rem .65rem;
            border: 1px solid transparent;
            border-radius: 6px;
            font-size: .8rem;
            font-weight: 600;
            text-decoration: none;
        }
        .table-action-edit { border-color: #c8e6b8; color: #2c7a00; }
        .table-action-edit:hover { background: #eef9e9; color: #2c7a00; }
        .table-action-view { border-color: #c9d9e8; color: #245b87; }
        .table-action-view:hover { background: #f0f7fc; color: #245b87; }
        .table-action-delete { border-color: #f2c5c0; background: #fff; color: #b3261e; cursor: pointer; }
        .table-action-delete:hover { background: #fff1ef; }
        .management-empty, .management-no-results { padding: 2.5rem !important; color: #6b7280; text-align: center; }
        .news-summary-cell { display: block; max-width: 360px; margin-top: .25rem; color: #6b7280; font-size: .78rem; }
        .news-status { display: inline-block; padding: .35rem .6rem; border-radius: 999px; font-size: .75rem; font-weight: 700; }
        .news-status-published { background: #eaf6e4; color: #2c7a00; }
        .news-status-draft { background: #fff0df; color: #b96000; }
        .form-management-card { max-width: 850px; padding: 1.5rem; border: 1px solid #e1e5de; border-radius: 12px; background: #fff; box-shadow: 0 6px 18px rgba(0, 0, 0, .06); }
        .news-form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-management-card .form-group { margin-bottom: 1.1rem; }
        .form-management-card .form-group label { display: block; margin-bottom: .4rem; font-weight: 600; }
        .form-management-card input[type="text"], .form-management-card input[type="file"], .form-management-card textarea { width: 100%; padding: .7rem .8rem; border: 1px solid #d8ded5; border-radius: 7px; font: inherit; }
        .form-management-card textarea { resize: vertical; }
        .form-management-card small { display: block; margin-top: .35rem; color: #6b7280; }
        .news-publish-toggle { display: flex; align-items: center; gap: .5rem; margin: 1rem 0; font-weight: 600; }
        .news-detail-card { overflow: hidden; max-width: 900px; border: 1px solid #e1e5de; border-radius: 12px; background: #fff; box-shadow: 0 6px 18px rgba(0, 0, 0, .06); }
        .news-detail-image { display: block; width: 100%; max-height: 360px; object-fit: cover; }
        .news-detail-body { padding: 2rem; }
        .news-detail-body h2 { margin: .8rem 0 .35rem; font-size: 2rem; }
        .news-detail-date { margin: 0; color: #6b7280; font-size: .85rem; }
        .news-detail-summary { margin: 1.5rem 0 1rem; color: #4b554a; font-size: 1.05rem; font-weight: 600; line-height: 1.6; }
        .news-detail-content { color: #4b554a; line-height: 1.75; }
        .detail-card {
            overflow: hidden;
            border: 1px solid #e1e5de;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .06);
        }
        .detail-card-heading {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.5rem;
            border-bottom: 1px solid #edf0eb;
        }
        .detail-record-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 58px;
            height: 58px;
            border-radius: 14px;
            background: #eaf6e4;
            color: #2c7a00;
            font-size: 1.5rem;
            font-weight: 700;
        }
        .detail-label {
            color: #6b7280;
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .06em;
        }
        .detail-card h2 { margin: .25rem 0 0; font-size: 1.5rem; }
        .detail-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1px;
            background: #e1e5de;
        }
        .detail-stat { padding: 1.25rem; background: #fff; }
        .detail-stat span { display: block; color: #6b7280; font-size: .78rem; margin-bottom: .45rem; }
        .detail-stat strong { color: #23261f; font-size: 1.05rem; }
        .related-details {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.25rem;
            padding: 1.5rem;
        }
        .related-section {
            padding: 1.15rem;
            border: 1px solid #e1e5de;
            border-radius: 10px;
        }
        .related-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: .75rem;
        }
        .related-heading h3 { margin: .25rem 0 0; font-size: 1.05rem; }
        .related-count {
            min-width: 28px;
            padding: .3rem .5rem;
            border-radius: 999px;
            background: #eaf6e4;
            color: #2c7a00;
            font-size: .8rem;
            font-weight: 700;
            text-align: center;
        }
        .related-item {
            display: flex;
            align-items: center;
            gap: .7rem;
            padding: .75rem 0;
            border-top: 1px solid #edf0eb;
        }
        .related-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            flex-shrink: 0;
            border-radius: 8px;
            background: #eaf6e4;
            color: #2c7a00;
            font-size: .8rem;
            font-weight: 700;
        }
        .related-icon-orange { background: #fff0df; color: #b96000; }
        .related-item strong,
        .related-item span { display: block; }
        .related-item strong { font-size: .88rem; }
        .related-item div span { margin-top: .2rem; color: #6b7280; font-size: .78rem; }
        .related-empty { margin: .9rem 0 .2rem; color: #6b7280; font-size: .85rem; }
        .detail-actions {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: 1.25rem 1.5rem;
            background: #fbfcfa;
        }
        .detail-actions form { margin: 0; }
        @media (max-width: 640px) {
            .management-page { padding: 1.5rem .75rem; }
            .management-header { align-items: stretch; flex-direction: column; }
            .management-primary-action { justify-content: center; }
            .management-toolbar { align-items: stretch; flex-direction: column; }
            .management-search { min-width: 0; }
            .management-actions { align-items: flex-end; flex-direction: column; }
            .detail-stats { grid-template-columns: repeat(2, 1fr); }
            .related-details { grid-template-columns: 1fr; padding: 1rem; }
            .detail-actions { align-items: stretch; flex-direction: column; }
            .detail-actions .management-primary-action { justify-content: center; }
            .detail-actions .table-action { text-align: center; width: 100%; }
            .news-form-grid { grid-template-columns: 1fr; }
        }
        .navbar {
            background-color: #2e7d32 !important;
        }
        .navbar-brand,
        .nav-link {
            color: #ffffff !important;
        }
        .nav-link:hover {
            color: #c8e6c9 !important;
        }
        .alert-success {
            background-color: #dcedc8 !important;
            border-color: #c5e1a5 !important;
            color: #2e7d32 !important;
        }
    </style>
</head>
<body>
    {{-- Mostrar la barra de navegación en todas las páginas que usen este layout --}}
    @include('includes.navbar')

    {{-- Aquí se inserta el contenido de cada vista --}}
    @yield('content')

    {{-- Footer global para todas las páginas --}}
    @include('includes.footer')

    {{-- Cargar JavaScript de Bootstrap para que funcione el botón hamburguesa --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
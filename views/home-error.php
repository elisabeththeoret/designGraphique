{{ include('header.php', { title: 'Erreur 404' }) }}

<body>
    {{ include('nav-principale.php') }}
    
    <main>
        <header class="flex-row">
            <h1 class="error">404 Not Found</h1>
        </header>
        
        <p>Oups! Une erreur s'est produite</p>
    </main>
    
    {{ include('footer.php') }}
</body>
</html>

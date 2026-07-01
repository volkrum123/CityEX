<h1>Cities</h1>

<form method="GET" action="/php/CityEX/public/cities">
    <input
        type="text"
        name="search"
        placeholder="Search cities..."
        value="<?= htmlspecialchars($search ?? '') ?>"
    >

    <button type="submit">
        Search
    </button>
</form>

<?php if (empty($cities)): ?>

    <p>No cities found.</p>

<?php else: ?>

    <ul>

        <?php foreach ($cities as $city): ?>

            <li>
                <a href="/php/CityEX/public/cities/<?= htmlspecialchars((string)$city['id']) ?>">
                    <?= htmlspecialchars($city['city']) ?>
                </a>
            </li>

        <?php endforeach; ?>

    </ul>

<?php endif; ?>
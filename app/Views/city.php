<h1><?= htmlspecialchars($city['city']) ?></h1>

<hr>

<p>
    <strong>Country:</strong>
    <?= htmlspecialchars($city['country'] ?? 'N/A') ?>
</p>

<p>
    <strong>Population:</strong>
    <?= htmlspecialchars((string)($city['population'] ?? 'N/A')) ?>
</p>

<p>
    <strong>City ID:</strong>
    <?= htmlspecialchars((string)$city['id']) ?>
</p>

<?php if (isset($city['lat'], $city['lng'])): ?>
    <p>
        <strong>Coordinates:</strong>
        <?= htmlspecialchars((string)$city['lat']) ?>,
        <?= htmlspecialchars((string)$city['lng']) ?>
    </p>
<?php endif; ?>

<hr>

<a href="/php/CityEX/public/cities">
    ← Back to cities
</a>
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

<hr>

<form method="GET" action="/php/CityEX/public/cities">

    <input type="hidden" name="search" value="<?= htmlspecialchars($search ?? '') ?>">

    <select name="sort" onchange="this.form.submit()">

        <option value="city_asc"  <?= ($sort ?? '') === 'city_asc' ? 'selected' : '' ?>>
            City A → Z
        </option>

        <option value="city_desc" <?= ($sort ?? '') === 'city_desc' ? 'selected' : '' ?>>
            City Z → A
        </option>

    </select>

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

    <hr>

    <?php
        // Safe defaults (prevents undefined variable warnings)
        $currentPage = $currentPage ?? 1;
        $totalPages = $totalPages ?? 1;
        $search = $search ?? '';
    ?>

    <nav>

        <?php if ($currentPage > 1): ?>
            <a href="/php/CityEX/public/cities?page=<?= $currentPage - 1 ?>&search=<?= urlencode($search) ?>">
                ← Previous
            </a>
        <?php endif; ?>

        &nbsp;

        Page <?= $currentPage ?> of <?= $totalPages ?>

        &nbsp;

        <?php if ($currentPage < $totalPages): ?>
            <a href="/php/CityEX/public/cities?page=<?= $currentPage + 1 ?>&search=<?= urlencode($search) ?>">
                Next →
            </a>
        <?php endif; ?>

    </nav>

<?php endif; ?>
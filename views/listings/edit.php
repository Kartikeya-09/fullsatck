<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Listing</title>
</head>
<body>
    <h1>Edit Listing</h1>
    <form action="/listings/<?= urlencode($listing->id) ?>?_method=PUT" method="post">
        <input type="hidden" name="_method" value="PUT"> <!-- Use PUT method -->
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="<?= htmlspecialchars($listing->title) ?>">
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description"><?= htmlspecialchars($listing->description) ?></textarea>
        </div>
        <div>
            <label for="price">Price</label>
            <input type="number" name="price" id="price" value="<?= htmlspecialchars($listing->price) ?>">
        </div>
        <div>
            <label for="category">Category</label>
            <select name="category" id="category">
                <option value="Switch Modular and Luxury" <?= $listing->category == "Switch Modular and Luxury" ? "selected" : "" ?>>Switch Modular and Luxury</option>
                <option value="Wires" <?= $listing->category == "Wires" ? "selected" : "" ?>>Wires</option>
                <option value="Camera Dom and Bullet" <?= $listing->category == "Camera Dom and Bullet" ? "selected" : "" ?>>Camera Dom and Bullet</option>
                <option value="Motorised Gate and Curtain" <?= $listing->category == "Motorised Gate and Curtain" ? "selected" : "" ?>>Motorised Gate and Curtain</option>
                <option value="Home Theater and Audio" <?= $listing->category == "Home Theater and Audio" ? "selected" : "" ?>>Home Theater and Audio</option>
                <option value="Fans" <?= $listing->category == "Fans" ? "selected" : "" ?>>Fans</option>
                <option value="Solar Panel" <?= $listing->category == "Solar Panel" ? "selected" : "" ?>>Solar Panel</option>
            </select>
        </div>
        <div>
            <label for="image">Image URL</label>
            <input type="text" name="image" id="image" value="<?= htmlspecialchars($listing->image) ?>">
        </div>
        <button type="submit">Update Listing</button>
    </form>
</body>
</html>

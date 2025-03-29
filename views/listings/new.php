<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Listing</title>
</head>
<body>
    <h1>Create New Listing</h1>
    <form action="/listings" method="post">
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title">
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <div>
            <label for="price">Price</label>
            <input type="number" name="price" id="price">
        </div>
        <div>
            <label for="category">Category</label>
            <select name="category" id="category">
                <option value="Switch Modular and Luxury">Switch Modular and Luxury</option>
                <option value="Wires">Wires</option>
                <option value="Camera Dom and Bullet">Camera Dom and Bullet</option>
                <option value="Motorised Gate and Curtain">Motorised Gate and Curtain</option>
                <option value="Home Theater and Audio">Home Theater and Audio</option>
                <option value="Fans">Fans</option>
                <option value="Solar Panel">Solar Panel</option>
            </select>
        </div>
        <div>
            <label for="image">Image URL</label>
            <input type="text" name="image" id="image">
        </div>
        <button type="submit">Create Listing</button>
    </form>
</body>
</html>
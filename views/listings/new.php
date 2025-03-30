<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Listing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Create New Listing</h1>
        <form action="/listings/create" method="post"> <!-- Updated action -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="category" id="category" class="form-select" required>
                    <option value="Switch Modular and Luxury">Switch Modular and Luxury</option>
                    <option value="Wires">Wires</option>
                    <option value="Camera Dom and Bullet">Camera Dom and Bullet</option>
                    <option value="Motorised Gate and Curtain">Motorised Gate and Curtain</option>
                    <option value="Home Theater and Audio">Home Theater and Audio</option>
                    <option value="Fans">Fans</option>
                    <option value="Solar Panel">Solar Panel</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image URL</label>
                <input type="text" name="image" id="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Create Listing</button>
        </form>
    </div>
</body>
</html>
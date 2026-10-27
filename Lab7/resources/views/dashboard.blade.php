<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Reading List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">My Reading List</a>
        <div class="d-flex align-items-center gap-3 text-white">
            <span>{{ auth()->user()->name ?? auth()->user()->email }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">Log out</button>
            </form>
        </div>
    </div>
</nav>

<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h1 class="h3 mb-4">Book Registration</h1>

            @if (session('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif

            <section class="card shadow-sm mb-4">
                <div class="card-header fw-semibold">Register a Book</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('books.store') }}" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input id="title" name="title" type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   maxlength="150" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input id="author" name="author" type="text"
                                   class="form-control @error('author') is-invalid @enderror"
                                   maxlength="100" value="{{ old('author') }}" required>
                            @error('author')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pages" class="form-label">Pages</label>
                            <input id="pages" name="pages" type="number"
                                   class="form-control @error('pages') is-invalid @enderror"
                                   min="1" max="10000" step="1" value="{{ old('pages') }}" required>
                            @error('pages')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Register Book</button>
                    </form>
                </div>
            </section>

            <section class="card shadow-sm">
                <div class="card-header fw-semibold">My Books</div>
                <div class="card-body">
                    @if ($books->isEmpty())
                        <p class="text-secondary mb-0">You have not registered any books yet.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Pages</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $book)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ $book->author }}</td>
                                            <td>{{ $book->pages }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
</main>
</body>
</html>

<x-layout>
  <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Cabeçalho -->
                <div class="mb-4">
                    <a href="{{ route('books.index') }}" class="text-decoration-none mb-2 d-inline-block">← Voltar para Livros</a>
                    <h1 class="mb-1">Adicionar Novo Livro</h1>
                    <p class="text-muted mb-0">Preencha os detalhes para adicionar um livro à sua coleção</p>
                </div>

                <!-- Formulário -->
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form>
                            @csrf
                            <!-- Título -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Título do Livro <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Digite o título do livro" required>
                            </div>

                            <!-- Autor -->
                            <div class="mb-3">
                                <label for="author" class="form-label">Autor <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="author" name="author" placeholder="Digite o nome do autor" required>
                            </div>

                            <!-- Capa do Livro -->
                            <div class="mb-3">
                                <label for="cover" class="form-label">Capa do Livro</label>
                                <input type="file" class="form-control" id="cover" name="cover" accept="image/*">
                                <div class="form-text">Imagem JPG, PNG ou WebP (máx. 2MB)</div>
                            </div>

                            <!-- Gênero e Ano de Publicação -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="genre" class="form-label">Gênero <span class="text-danger">*</span></label>
                                    <select class="form-select" id="genre_id" name="genre_id" required>
                                        <option value="">Selecione o Gênero</option>
                                        @foreach ($genres as $genre)
                                          <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="published" class="form-label">Ano de Publicação <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="published" name="published" placeholder="2025" min="1000" max="2099" required>
                                </div>
                            </div>

                            <!-- Descrição -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Descrição</label>
                                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Digite a descrição do livro..."></textarea>
                            </div>

                            <!-- Botões -->
                            <div class="d-flex gap-3 mt-4">
                                <button type="submit" class="btn btn-primary px-4">Adicionar Livro</button>
                                <a href="{{ route('books.index') }}" class="btn btn-outline-secondary px-4">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
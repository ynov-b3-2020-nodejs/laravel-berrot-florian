                          @extends('products.layout')

                          @section('content')
                              <div class="row">
                                  <div class="col-lg-12 margin-tb">
                                      <div class="pull-left">
                                          <h2>Modifier un produit</h2>
                                      </div>
                                      <div class="pull-right">
                                          <a class="btn btn-primary" href="{{ route('products.index') }}"> Retour</a>
                                      </div>
                                  </div>
                              </div>

                              @if ($errors->any())
                                  <div class="alert alert-danger">
                                      <strong>Attention il y eu un probleme<br><br>
                                      <ul>
                                          @foreach ($errors->all() as $error)
                                              <li>{{ $error }}</li>
                                          @endforeach
                                      </ul>
                                  </div>
                              @endif

                              <form action="{{ route('products.update',$product->id) }}" method="POST">
                                  @csrf
                                  @method('PUT')

                                   <div class="row">
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                          <div class="form-group">
                                              <strong>Nom:</strong>
                                              <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Nom">
                                          </div>
                                      </div>
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                          <div class="form-group">
                                              <strong>Detail:</strong>
                                              <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $product->detail }}</textarea>
                                          </div>
                                      </div>
                                      <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary">Modifier</button>
                                      </div>
                                  </div>

                              </form>
                          @endsection

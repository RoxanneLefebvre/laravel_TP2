<div class="row mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <p>FORUM

                            </p>
                            
                            <small>@lang('lang.forum_note')</small>
                            @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                        @endif
                        </div>
                        <div class="card-body">
                            <ul>
                                @forelse($files as $file)
                                    
                                @if($locale=='en')
                        <div class="w-100 mb-2">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center ">
                                        <div class="col mr-2">

                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <a href="{{ route('repo.show', $file->id)}}">{{ $file->title }}</a></div>
                                                <i class="fas fa-calendar fa-2x text-gray-300">{{ $file->repoHasUser->name }}</i>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-truncate"><a href="{{ $file->path }}"></a></div>
                                    

                                        </div>

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($locale=='fr')
                            @if($file->title_fr)
                            <div class="w-100 mb-2">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center ">
                                            <div class="col mr-2">

                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    <a href="{{ route('repo.show', $file->id)}}">{{ $file->title_fr }}</a></div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800 text-truncate"><a href="{{ $file->path }}"></a></div>
                                                
                                                
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endif
                                    @empty
                                    <li class="text-danger">Aucune file trouver</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
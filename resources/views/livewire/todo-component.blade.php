<div>
    <div class="row">
        <div class="col-4 mx-auto">
            <div class="text-center">
                <h1 class="display-3" style="color: rgb(238, 202, 202)">todos</h1>
            </div>

            <ul class="list-group list-group-flush rounded-0 shadow">

                <li class="list-group-item list-group-item-action p-0 m-0 border-0">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text border-0" style="background-color: white !important;"
                                id="basic-addon1">
                                @if ($todoArray)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                @endif
                            </span>
                        </div>

                        <input wire:keydown.enter="addTodo" wire:model="todoText" type="text"
                            class="border-0 p-3 form-control rounded-0" placeholder="What needs to be done?"
                            aria-label="Username" aria-describedby="basic-addon1" autofocus>
                    </div>

                </li>

                @php
                    $showClearCompleted = false;
                @endphp

                @foreach ($todoArray as $i => $todo)

                    @if ($showAll == true || $todo['cross'] == $showActiveOrCompleted)

                        <li class="list-group-item list-group-item-action hovereffect">

                            <input wire:click="checkCross({{ $i }})" value="{{ $i }}"
                                class="form-check-input" type="checkbox" {{ $todo['cross'] ? 'checked' : '' }}>

                            <div class="form-check">

                                <label class="form-check-label w-100">

                                    @if ($todo['showInput'])

                                        <input wire:model="todoInput.{{ $i }}"
                                            wire:keydown.enter="update({{ $i }})" type="text"
                                            class="form-control rounded-0">

                                    @else

                                        <div class="row">
                                            <div class="col-11" id="id-{{ $i }}"
                                                wire:click="edit({{ $i }})">

                                                @if ($todo['cross'])
                                                    <s>{{ $todo['text'] }}</s>
                                                @else
                                                    {{ $todo['text'] }}
                                                @endif

                                            </div>

                                            <div class="col-1 X" wire:click="delete({{ $i }})"
                                                style="display: none">X</div>
                                        </div>

                                    @endif

                                </label>

                            </div>

                        </li>

                    @endif

                    @if ($todo['cross'] == true)
                        @php
                            $showClearCompleted = true;
                        @endphp
                    @endif

                @endforeach

                @if ($todoArray)

                    <li class="list-group-item">

                        <ul class="nav nav-pills justify-content-between">
                            <li class="nav-item">
                                <small>{{ $leftItem }} Item Left</small>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark {{ $selected == 1 ? 'active' : '' }}" wire:click="all"
                                    data-toggle="tab" href="#home"><small>All</small></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark {{ $selected == 2 ? 'active' : '' }}"
                                    wire:click="active" data-toggle="tab" href="#menu1"><small>Active</small></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark {{ $selected == 3 ? 'active' : '' }}"
                                    wire:click="completed" data-toggle="tab" href="#menu2"><small>Completed</small></a>
                            </li>
                            <li class="nav-item">
                                @if ($showClearCompleted)
                                    <a class="nav-link text-dark" wire:click="clearCompleted" href="#"><small>Clear
                                            Completed</small></a>
                                @endif
                            </li>
                        </ul>

                    </li>
                @endif

            </ul>

        </div>
    </div>
    <style>
        .dropdown:hover>.dropdown-menu {
            display: block;
            margin: 0;
        }

        a:hover {
            color: #F7850A !important;
            text-decoration: none;
        }

        a {
            color: black;
        }

        .row:hover>.X {
            display: block !important;
        }

        .form-control,
        .form-control:focus {
            box-shadow: none;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: rgb(80, 78, 78);
            background-color: rgb(228, 228, 228);
        }

        .nav-link {
            display: block;
            padding: 0rem .2rem;
        }

        .list-group-item:first-child {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        ::-webkit-input-placeholder {
            font-size: 20px !important;
            font-weight: 400px !important;
            color: rgb(231, 231, 231) !important;
            font-style: italic;
        }

        :-moz-placeholder {
            /* Firefox 18- */
            font-size: 20px !important;
            font-weight: 400px !important;
            color: rgb(231, 231, 231) !important;
            font-style: italic;
        }

        ::-moz-placeholder {
            /* Firefox 19+ */
            font-size: 20px !important;
            font-weight: 400px !important;
            color: rgb(231, 231, 231) !important;
            font-style: italic;
        }

    </style>

</div>

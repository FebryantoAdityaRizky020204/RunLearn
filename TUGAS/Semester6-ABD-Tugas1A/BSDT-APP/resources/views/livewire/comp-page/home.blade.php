<div class="col">
    <h5 class="mb-3 fw-bold">
        HOME
    </h5>
    @php
        // var_dump($data)
    @endphp
    <div class="col mb-2 bg-dark p-2 rounded-1">
        <button type="button" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-plus"></i>
            Tambah Data
        </button>

    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm">
                        <i class="fa-solid fa-trash"></i>
                    </button>

                </td>
            </tr>
        </tbody>
    </table>
</div>

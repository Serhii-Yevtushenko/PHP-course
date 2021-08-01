<div class="container">
    <div class="row">
        <div class="col" align="left">
            <h3>
                Библиотека++
            </h3>
        </div>
        <div class="col" align="right">
            <h3>
                <a href="/">Exit</a>
            </h3>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col">

            <br/>
            <br/>

            <table
                    data-toggle="table"
                    data-url="data1.json"
                    data-pagination="true"
                    data-search="false">
                <thead>
                <tr>
                    <th data-sortable="true" data-field="id">Item ID</th>
                    <th data-sortable="true" data-field="name">Item Name</th>
                    <th data-sortable="true" data-field="price">Item Price</th>
                </tr>
                </thead>
            </table>

        </div>
        <div class="col">
            <form>
                <fieldset>
                    <legend>добавить новую книгу</legend>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="название книги">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="автор1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="год издания">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="автор2">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="file" class="form-control-file" id="customFile">
                            </div>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="автор3">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <img src="/images/22.jpg" class="img-fluid">
                        </div>
                        <div class="col">
                            <textarea class="form-control" placeholder="описание книги"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <div class="col">
                            <label>оставьте поля пустыми если авторов &lt3</label>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

                <div class="accordion-item">
                  <h2 class="accordion-header bg-info bg-gradient" id="headingSecond">
                    <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse"
                      data-mdb-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Noteに投稿する
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-mdb-parent="#accordionExample">
                    <div class="accordion-body">
                      <form class="p-4" method="POST">
                        <div class="input-group date mb-3" id="datetimepicker1" data-target-input="nearest">
                          <label for="datetimepicker1" class="pt-1 pr-1">日付</label>
                          <input type="text" id="NoteDate" data-input class="form-control"
                            data-target="#datetimepicker1" style='background:white' />
                          <div class="input-group-text" data-target="#datetimepicker1" data-toggle="datetimepicker">
                            <i class="far fa-calendar-alt"></i>
                          </div>
                        </div>
                        <br>
                        <div class=row>
                          <div class="col-2"></div>
                          <button type="button" id="CallNoteDate" class="btn btn-outline-info col-3"
                            data-mdb-ripple-color="dark">
                            内容を呼びだす
                          </button>
                          <div class="col-2"></div>
                          <button type="button" id="NoteClear" class="btn btn-outline-info col-3"
                            data-mdb-ripple-color="dark">
                            元に戻す
                          </button>
                          <div class="col-2"></div>
                        </div>
                        <br>
                        <label class="pt-1 pr-1">タイトル</label>
                        <br>
                        <div class="form-outline">
                          <input type="text" class="form-control form-control-sm" id="NoteTitle" />
                        </div>
                        <br>
                        <label class="pt-1 pr-1">本文</label>
                        <div class="form-outline">
                          <br>
                          <textarea class="form-control" id="NoteContent" rows="15"></textarea>
                          <label class="form-label" for="textAreaExample"></label>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
@extends('layouts.admin')

@section('title')
Thư khách hàng
@endsection

@section('content')

<div>
    <div class="card">
        <div class="card-header">
           <div class="row">
                <h4>Thư khách hàng </h4>
                <a href="" class="btn btn-success btn-sm ml-auto">Thêm danh mục</a>
           </div>
        </div>
        <div class="card-body">
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th>Stt</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Nội dung</th>
                        <th>Xử lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $i)
                    <tr>
                        <td>1</td>
                        <td>{{ $i->name }}</td>
                        <td>
                            {{ $i->email }}
                        </td>
                        <td>{{ $i->message }}</td>
                       
                        <td>
                        
                           <!-- Button trigger modal -->
                           <button type="button"  class="btn btn-success btn-sm" data-toggle="modal" data-target="#replyMessage{{$i->id}}" data-answered="false">Trả lời</button>
                           <div class="modal fade" id="replyMessage{{$i->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog">
                                 <div class="modal-content">
                                   <div class="modal-header">
                                     <h5 class="modal-title" id="exampleModalLabel">Trả lời tin nhắn</h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                     </button>
                                   </div>
                                   <div class="modal-body">
                                      <textarea class="form-control" name="emailContent" id="emailContent{{ $i->id }}" rows="10"></textarea>
                                   </div>
                                   <div class="modal-footer">
                                     <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Hủy</button>
                                     <button type="button" data-message-id="{{ $i->id }}"  data-email="{{ $i->email }}" class="btn btn-danger btn-sm send-email-btn">Gửi</button>
                                   </div>
                                 </div>
                               </div>
                             </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection

@section('pushjs')

<script>

    $(document).ready(function() {
        $('.send-email-btn').on('click', function() {
            var messageId = $(this).data('message-id');
            var customerEmail = $(this).data('email');
            var emailContent = $('#emailContent' + messageId).val();

        
           console.log(customerEmail);
           console.log(emailContent);

           $.ajax({
                url: '/admin/send-reply-email',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    // messageId: messageId,
                    customerEmail: customerEmail,
                    emailContent: emailContent
                },
                success: function(response) {
                    alert('Gửi email thành công!');
                    $('#replyMessage' + messageId).modal('hide');
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Có lỗi.');
                }
            });
        });
    });


</script>

@endsection
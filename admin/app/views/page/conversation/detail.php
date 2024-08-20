<style>
    .scroll-area {
        height: 500px;
        overflow-y: scroll;
        background: #fbfbfb;
    }
</style>

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <?php
                $data = $conversations;
                ?>

                <input type="hidden" value="<?php echo $data[0]['cvs_id']; ?>" id="conversation_id">

                <div class="card-header pb-0">
                    <div class="d-flex justify-content-start gap-3">
                        <a href="<?php echo URL_APP . '/conversation'; ?>" class="mb-0 d-flex align-items-center" type="button"><i class="fas fa-arrow-left fs-6"></i></a>
                        <div>
                            <h5 class="mb-0 fw-bolder text-dark fs-5">
                                Khách hàng "<?php echo isset($data[0]['customer_name']) ? $data[0]['customer_name'] : 'Ẩn danh'; ?>"
                            </h5>
                        </div>
                    </div>
                </div>

                <?php if (isset($_SESSION['success'])) : ?>
                    <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                        <span class="alert-text text-white">
                            <?php echo $_SESSION['success']; ?>
                        </span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                <?php endif; ?>

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="scroll-area card shadow-none border-1 rounded mx-4 my-2 p-2" id="messageContainer">
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between gap-3">
                        <input type="text" class="form-control" rows="1" placeholder="message..." name="content" id="msg_content"></input>
                        <input type="hidden" value="<?php echo $data[0]['cvs_id']; ?>" name="cvs_id">
                        <button type="button" class="btn bg-gradient-primary btn-md d-flex" style="gap: 10px;" id="sendMessage">
                            Gửi <i class="far fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const URL = "http://localhost/phone-ecommerce-chat/admin"
    const URL_IMAGES = "http://localhost/phone-ecommerce-chat/storages/public"
    const conversationId = $('#conversation_id').val();

    // Fetch 
    const fetchConversation = async () => {
        try {
            const response = await fetch(`${URL}/conversation/getDetailMessage/${conversationId}`);
            const data = await response.json();
            if (data.status === 200) {
                renderMessages(data.data);
            } else if (data.status === 204) {
                console.log(data.message);
            } else {
                console.log(data.message);
            }
        } catch (error) {
            showToast('Có lỗi xảy ra: ' + error, false);
        }
    }

    const updateMessageStatus = async () => {
        try {
            const response = await fetch(`${URL}/conversation/updateMessageStatus/${conversationId}`);
            const data = await response.json();
            if (data.status === 200) {
                console.log('update success');
            } else {
                console.log('update fail!');
            }
        } catch (error) {
            showToast('Có lỗi xảy ra: ' + error, false);
        }
    }

    const deleteMessage = async (id) => {
        console.log(id);
        try {
            const response = await fetch(`${URL}/conversation/deleteMessage/${id}`);
            const data = await response.json();
            if (data.status === 204) {
                showToast('Đã xóa tin nhắn', true);
            } else {
                showToast('Xóa tin nhắn không thành công', false);
            }
            fetchConversation()
        } catch (error) {
            showToast('Có lỗi xảy ra: ' + error, false);
        }
    }

    // Render 
    const renderMessages = (messages) => {
        const messageContainer = document.getElementById('messageContainer');

        const messagesHTML = messages.map((message, index) => {
            if (message.sender_type === "customer") {
                return `
                <!-- Customer Message -->
                <div class="d-flex flex-row mb-3">
                    <div class="p-2 bg-light rounded">
                        <p class="mb-0">${message.content}</p>
                    </div>
                </div>
            `;
            } else {
                return `
                <!-- Admin Message -->
                <div class="d-flex flex-row-reverse mb-3" data-bs-toggle="modal" data-bs-target="#deleteMessageModal${index}">
                    <div class="p-2 bg-primary text-white rounded">
                        <p class="mb-0">${message.content}</p>
                    </div>
                </div>

                <div class="modal fade" id="deleteMessageModal${index}" tabindex="-1" aria-labelledby="deleteMessage${index}ModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p class="text-center text-dark fw-bold">Bạn có chắc chắn muốn xóa tin nhắn này?</p>
                                <div class="d-flex justify-content-center mt-3 gap-3 ">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                                    <button type="button" class="btn btn-danger" onclick="deleteMessage('${message.id}')" data-bs-dismiss="modal">Xóa tin nhắn</button>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
            `;
            }
        }).join('');

        messageContainer.innerHTML = messagesHTML;
        messageContainer.scrollTo(0, messageContainer.scrollHeight);
    }

    // Actions 
    $(document).ready(function() {
        fetchConversation()
        updateMessageStatus()

        const chatInput = document.getElementById("msg_content");
        chatInput.addEventListener("keydown", (e) => {
            if (e.key === "Enter" && !e.shiftKey && window.innerWidth > 800) {
                e.preventDefault();
                const data = {
                    cvs_id: conversationId,
                    content: $('#msg_content').val()
                }

                $.ajax({
                    url: 'http://localhost/phone-ecommerce-chat/admin/conversation/createMessageByAdmin',
                    type: 'POST',
                    data: data,
                    success: function(res) {
                        if (res.status === 200) {
                            // showToast(res.message, true);
                            fetchConversation();
                            $('#msg_content').val("");
                        } else {
                            showToast(res.message, false);
                            fetchConversation();
                        }
                    },
                    error: function(xhr, error) {
                        showToast('Error: ' + 'error', false);
                    }
                });
            }
        });


        $('#sendMessage').click(function(e) {
            const data = {
                cvs_id: conversationId,
                content: $('#msg_content').val()
            }

            $.ajax({
                url: 'http://localhost/phone-ecommerce-chat/admin/conversation/createMessageByAdmin',
                type: 'POST',
                data: data,
                success: function(res) {
                    if (res.status === 200) {
                        // showToast(res.message, true);
                        fetchConversation();
                        $('#msg_content').val("");
                    } else {
                        showToast(res.message, false);
                        fetchConversation();
                    }
                },
                error: function(xhr, error) {
                    showToast('Error: ' + 'error', false);
                }
            });
        });

        setInterval(fetchConversation, 5000);
    });
</script>
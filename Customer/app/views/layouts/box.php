<style>
    /* Chatbox */

    .chatbot-toggler {
        position: fixed;
        bottom: 30px;
        right: 35px;
        outline: none;
        border: none;
        height: 50px;
        width: 50px;
        display: flex;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #724ae8;
        transition: all 0.2s ease;
    }

    body.show-chatbot .chatbot-toggler {
        transform: rotate(90deg);
    }

    .chatbot-toggler span {
        color: #fff;
        position: absolute;
    }

    .chatbot-toggler span:last-child,
    body.show-chatbot .chatbot-toggler span:first-child {
        opacity: 0;
    }

    body.show-chatbot .chatbot-toggler span:last-child {
        opacity: 1;
    }

    .chatbot {
        position: fixed;
        right: 35px;
        bottom: 90px;
        width: 420px;
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        opacity: 0;
        pointer-events: none;
        transform: scale(0.5);
        transform-origin: bottom right;
        box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1),
            0 32px 64px -48px rgba(0, 0, 0, 0.5);
        transition: all 0.1s ease;
        z-index: 100000;
    }

    body.show-chatbot .chatbot {
        opacity: 1;
        pointer-events: auto;
        transform: scale(1);
    }

    .chatbot header {
        padding: 16px 0;
        position: relative;
        text-align: center;
        color: #fff;
        background: #724ae8;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .chatbot header span {
        position: absolute;
        right: 15px;
        top: 50%;
        display: none;
        cursor: pointer;
        transform: translateY(-50%);
    }

    header h2 {
        color: #fff;
        font-size: 1.4rem;
    }

    .chatbot .chatbox {
        overflow-y: auto;
        height: 510px;
        padding: 30px 20px 100px;
    }

    .chatbot :where(.chatbox, textarea)::-webkit-scrollbar {
        width: 6px;
    }

    .chatbot :where(.chatbox, textarea)::-webkit-scrollbar-track {
        background: #fff;
        border-radius: 25px;
    }

    .chatbot :where(.chatbox, textarea)::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 25px;
    }

    .chatbox .chat {
        display: flex;
        list-style: none;
    }

    .chatbox .outgoing {
        margin: 20px 0;
        justify-content: flex-end;
    }

    .chatbox .incoming span {
        width: 32px;
        height: 32px;
        color: #fff;
        cursor: default;
        text-align: center;
        line-height: 32px;
        align-self: flex-end;
        background: #724ae8;
        border-radius: 4px;
        margin: 0 10px 7px 0;
    }

    .chatbox .chat p {
        white-space: pre-wrap;
        padding: 12px 16px;
        border-radius: 10px 10px 0 10px;
        max-width: 75%;
        color: #fff;
        font-size: 0.95rem;
        background: #724ae8;
    }

    .chatbox .incoming p {
        border-radius: 10px 10px 10px 0;
    }

    .chatbox .chat p.error {
        color: #721c24;
        background: #f8d7da;
    }

    .chatbox .incoming p {
        color: #000;
        background: #f2f2f2;
    }

    .chatbot .chat-input {
        display: flex;
        gap: 5px;
        position: absolute;
        bottom: 0;
        width: 100%;
        background: #fff;
        padding: 3px 20px;
        border-top: 1px solid #ddd;
    }

    .chat-input textarea {
        height: 55px;
        width: 100%;
        border: none;
        outline: none;
        resize: none;
        max-height: 180px;
        padding: 15px 15px 15px 0;
        font-size: 0.95rem;
    }

    .chat-input span {
        align-self: flex-end;
        color: #724ae8;
        cursor: pointer;
        height: 55px;
        display: flex;
        align-items: center;
        visibility: hidden;
        font-size: 1.35rem;
    }

    .chat-input textarea:valid~span {
        visibility: visible;
    }

    @media (max-width: 490px) {
        .chatbot-toggler {
            right: 20px;
            bottom: 20px;
        }

        .chatbot {
            right: 0;
            bottom: 0;
            height: 100%;
            border-radius: 0;
            width: 100%;
        }

        .chatbot .chatbox {
            height: 90%;
            padding: 25px 15px 100px;
        }

        .chatbot .chat-input {
            padding: 5px 15px;
        }

        .chatbot header span {
            display: block;
        }
    }
</style>

<input type="hidden" value="<?php echo isset($_SESSION['auth']['customer_id']) ? $_SESSION['auth']['customer_id'] : "noconversation" ?>" id="cb_customer_id">

<button class="chatbot-toggler">
    <span class="badge rounded-pill bg-danger p-2" id="chatbox-notification" style="position: absolute;
            display: none;
            top: 0;
            right: -20%;
            transform: rotate(0deg);">
        <i class="fa fa-bell" aria-hidden="true"></i>
    </span>
    <span class="material-symbols-rounded">mode_comment</span>
    <span class="material-symbols-outlined">close</span>
</button>

<div class="chatbot">
    <header>
        <h2>Augentern CHATBOX</h2>
        <span class="close-btn material-symbols-outlined">close</span>
        <div class="form-check mt-1">
            <input class="form-check-input" type="checkbox" value="" id="isAdminChecked">
            <label class="form-check-label" for="isAdminChecked">
                Nhắn tin với admin
            </label>
        </div>
    </header>
    <span class="flex justify-content-center items-center mx-auto text-center mb-3">
        <!-- <span class="material-symbols-outlined">smart_toy</span> -->
        <p>Xin chào! 👋<br>Nhập "xin chào" hoặc "help" để bắt đầu trò chuyện?</p>
    </span>
    <ul class="chatbox">
        <li class="chat incoming">
            <span class="material-symbols-outlined">smart_toy</span>
            <p>Xin chào! 👋<br>Nhập "xin chào" hoặc "help" để bắt đầu trò chuyện?</p>
        </li>
    </ul>
    <div class="chat-input">
        <textarea placeholder="Enter a message..." spellcheck="false" required></textarea>
        <span id="send-btn" class="material-symbols-rounded">send</span>
    </div>
</div>

<script>
    const APITOKEN = "VNMZZ7NOD2XZCPRYHPYFREFTPPFMMBCT";

    const chatbotToggler = document.querySelector(".chatbot-toggler");
    const closeBtn = document.querySelector(".close-btn");
    const chatbox = document.querySelector(".chatbox");
    const chatInput = document.querySelector(".chat-input textarea");
    const sendChatBtn = document.querySelector(".chat-input span");

    let isAdminChated = false;
    const adminCheckbox = document.getElementById("isAdminChecked");
    adminCheckbox.addEventListener('change', function() {
        if (this.checked) {
            isAdminChated = true;
            console.log("Checkbox is checked..");
        } else {
            isAdminChated = false;
            console.log("Checkbox is unchecked..");
        }
    });

    let userMessage = null;
    const inputInitHeight = chatInput.scrollHeight;

    const createChatLi = (message, className) => {
        const chatLi = document.createElement("li");
        chatLi.classList.add("chat", `${className}`);
        let chatContent =
            className === "outgoing" ?
            `<p></p>` :
            `<span class="material-symbols-outlined">smart_toy</span><p></p>`;
        chatLi.innerHTML = chatContent;
        chatLi.querySelector("p").textContent = message;
        return chatLi; // return chat <li> element
    };
    /**
     * 1. Đầu tiên cần cái checkbox để bắt được người dùng đăng chọn nhắn tin với admin hay là AI
     * 2. Tiếp theo bắt sự kiện về thay đổi trên checkbox để theo dõi  hành động người dùng
     * 3. Cuối cùng kiểm tra nếu isAdminChated (admin trò chuyện) = true là đang nhắn tin với admin sẽ không cho con AI nó trả lời
     * Mà gửi thẳng tin nhắn qua Admin chỉ admin mới trả lời được.
     */
    /**
     * Xử lý tin nhắn trong chatbox dựa trên việc người dùng chọn nhắn tin với admin hay không.
     * Nếu người dùng chọn nhắn tin với admin, chỉ lưu tin nhắn của người dùng vào Database.
     * Nếu không, gửi tin nhắn của người dùng tới API của wit.ai để tự động trả lời.
     * Hàm này thực hiện việc tạo các phần tử chat và xử lý logic gửi và nhận tin nhắn trong chatbox.
     */
    const handleChat = (isAdminChated) => {
        const userMessage = chatInput.value.trim().toLowerCase();
        if (!userMessage) return;

        console.log(isAdminChated);

        chatInput.value = "";
        chatInput.style.height = `${inputInitHeight}px`;

        const outgoingChatLi = createChatLi(userMessage, "outgoing");
        chatbox.appendChild(outgoingChatLi);
        chatbox.scrollTo(0, chatbox.scrollHeight);

        /**
         * Nó sẽ check xem nếu như user chọn nhắn tin với admin thì sẽ chỉ lưu tin nhắn của user vào Database
         * Sau đó đợi admin trả lời
         */
        if (isAdminChated) {
            addMessageByCustomer(userMessage);

            /**
             * Ngược lại nó sẽ call API của con AI và tiến hành tự động trả lời. 
            
             */
        } else {
            /**
             * Tích hợp with AI tại đây.
             * Nó không hẳn gọi là tích hợp chỉ đơn giản là call API từ một chatbox AI của wit.ai 
             * Và con chatbox tạo ra và training nó để nó trả lời các câu hỏi từ người dùng.
             * Còn các việc như render giao diện hay gửi câu hỏi... Đều sử dụng Javascript và Jquery.
             * 
             */
            fetch(`https://api.wit.ai/message?v=20240522&q=${encodeURIComponent(userMessage)}`, {
                    method: "GET",
                    headers: {
                        "Authorization": `Bearer ${APITOKEN}`,
                    },
                })
                .then(response => response.json())
                .then(async data => {
                    const firstEntityKey = Object.keys(data.entities)[0]; // Lấy khóa đầu tiên trong entities
                    const firstEntity = data.entities[firstEntityKey]?.[0]; // Lấy entity đầu tiên trong mảng
                    const entityValue = firstEntity?.value; // Lấy giá trị của entity
                    if (entityValue == userMessage) {
                        responseMessage = "Xin lỗi, Tôi không hiểu bạn cần gì, Tôi sẽ chuyển tin nhắn của bạn đến cho Quản trị viên. Vui lòng trở lại trang web sau khoảng 1h để nhận thông báo mới. Bạn có thể nhập trợ giúp để tìm hiểu các lệnh"
                    } else if (entityValue) {
                        responseMessage = entityValue; // Gắn giá trị vào responseMessage
                    }

                    // add user message to message table
                    await addMessageByCustomer(userMessage);
                    await addMessageByAdmin(responseMessage);

                    const incomingChatLi = createChatLi(responseMessage, "incoming");
                    chatbox.appendChild(incomingChatLi);
                    chatbox.scrollTo(0, chatbox.scrollHeight);
                })
                .catch(async error => {
                    console.error("Error interacting with Wit.ai:", error);
                    const errorMsg = "Xin lỗi, Tôi không hiểu bạn cần gì, Tôi sẽ chuyển tin nhắn của bạn đến cho Quản trị viên. Vui lòng trở lại trang web sau khoảng 1h để nhận thông báo mới. Bạn có thể nhập trợ giúp để tìm hiểu các lệnh";
                    const errorChatLi = createChatLi(errorMsg, "incoming");
                    await addMessageByAdmin(errorMsg);

                    chatbox.appendChild(errorChatLi);
                    chatbox.scrollTo(0, chatbox.scrollHeight);
                });
        }
    };

    chatInput.addEventListener("input", () => {
        chatInput.style.height = `${inputInitHeight}px`;
        chatInput.style.height = `${chatInput.scrollHeight}px`;
    });

    chatInput.addEventListener("keydown", (e) => {
        if (e.key === "Enter" && !e.shiftKey && window.innerWidth > 800) {
            e.preventDefault();
            handleChat(isAdminChated);
        }
    });

    sendChatBtn.addEventListener("click", handleChat);
    closeBtn.addEventListener("click", () =>
        document.body.classList.remove("show-chatbot")
    );

    chatbotToggler.addEventListener("click", () => {
        createNewConversation();
        document.body.classList.toggle("show-chatbot")
    });

    const customerId = document.getElementById('cb_customer_id');
    let conversationByCustomer = null;
    const getMessageFromLocastorage = () => {
        const chatBoxNotification = document.getElementById('chatbox-notification');

        if (customerId.value === "noconversation") {
            const conversation = localStorage.getItem("conversation");
            let chatboxData = [];

            if (conversation) {
                chatboxData = JSON.parse(conversation);

                $.ajax({
                    type: 'GET',
                    url: "http://localhost/phone-ecommerce-chat/admin/conversation/getConversationByConversation/" + chatboxData.conversation.conversation_id,
                    success: function(res) {
                        // console.log(res.data[res.data.length - 1].msg_status);
                        if (res.status === 200) {
                            renderMessages(res.data);

                            if (res.data[res.data.length - 1].msg_status === "0") chatBoxNotification.style.display = "block";
                        } else {
                            console.log('error at get by conversation');
                        }
                    },
                    error: function(xhr, status, error) {
                        showToast('Có lỗi xảy ra: ' + error, false);
                    }
                });
            }
        } else {
            $.ajax({
                type: 'GET',
                url: "http://localhost/phone-ecommerce-chat/admin/conversation/getConversationByCustomerId/" + customerId.value,
                success: function(res) {
                    if (res.status === 200) {
                        // console.log(res.data[res.data.length - 1].msg_status);
                        renderMessages(res.data);
                        conversationByCustomer = res.data;

                        if (res.data[res.data.length - 1].msg_status === "0") chatBoxNotification.style.display = "block";
                    } else {
                        console.log('error at get by customer');
                    }
                },
                error: function(xhr, status, error) {
                    showToast('Có lỗi xảy ra: ' + error, false);
                }
            });
        }
    }

    const renderMessages = (messages) => {
        const chatbox = document.querySelector(".chatbox");
        chatbox.innerHTML = "";

        messages.forEach((message) => {
            const {
                sender_type,
                content
            } = message;
            const className = sender_type === 'customer' ? "outgoing" : "incoming";
            const chatLi = createChatLi(content, className);
            chatbox.appendChild(chatLi);
        });

        // chatbox.scrollTo(0, chatbox.scrollHeight);
    };

    const createNewConversation = () => {
        const conversation = localStorage.getItem("conversation");
        if (!conversation || conversation === null) {
            $.ajax({
                type: 'POST',
                url: "http://localhost/phone-ecommerce-chat/admin/conversation/store",
                success: function(res) {
                    if (res.status === 200) {
                        // console.log(res);
                        localStorage.setItem("conversation", JSON.stringify(res.data));
                    } else {
                        console.log('error at create conversation');
                    }
                },
                error: function(xhr, status, error) {
                    showToast('Có lỗi xảy ra: ' + error, false);
                }
            });
        }
    }

    const addMessageByCustomer = async (message) => {
        const conversation = localStorage.getItem("conversation");
        chatboxData = JSON.parse(conversation);

        if (customerId.value === "noconversation") {
            await $.ajax({
                type: 'POST',
                url: "http://localhost/phone-ecommerce-chat/admin/conversation/createMessageByCustomer",
                data: {
                    cvs_id: chatboxData.conversation.conversation_id,
                    content: message,
                },
                success: function(res) {
                    if (res.status === 200) {

                    } else {
                        console.log('error at add new message type customer');
                    }
                },
                error: function(xhr, status, error) {
                    showToast('Có lỗi xảy ra: ' + error, false);
                }
            });
        } else {
            await $.ajax({
                type: 'POST',
                url: "http://localhost/phone-ecommerce-chat/admin/conversation/createMessageByCustomer",
                data: {
                    cvs_id: conversationByCustomer[0].conversation_id,
                    content: message,
                },
                success: function(res) {
                    if (res.status === 200) {
                        // console.log(res);

                    } else {
                        console.log('error add new message type customer');
                    }
                },
                error: function(xhr, status, error) {
                    showToast('Có lỗi xảy ra: ' + error, false);
                }
            });
        }
    }

    const addMessageByAdmin = async (message) => {
        const conversation = localStorage.getItem("conversation");
        chatboxData = JSON.parse(conversation);

        if (customerId.value === "noconversation") {
            await $.ajax({
                type: 'POST',
                url: "http://localhost/phone-ecommerce-chat/admin/conversation/createMessageByAdmin",
                data: {
                    cvs_id: chatboxData.conversation.conversation_id,
                    content: message,
                },
                success: function(res) {
                    if (res.status === 200) {
                        // console.log(res);

                    } else {
                        console.log('error add new message type admin: ' + res.message);
                    }
                },
                error: function(xhr, status, error) {
                    showToast('Có lỗi xảy ra: ' + error, false);
                }
            });
        } else {
            await $.ajax({
                type: 'POST',
                url: "http://localhost/phone-ecommerce-chat/admin/conversation/createMessageByAdmin",
                data: {
                    cvs_id: conversationByCustomer[0].conversation_id,
                    content: message,
                },
                success: function(res) {
                    if (res.status === 200) {
                        // console.log(res);

                    } else {
                        console.log('error add new message type admin: ' + res.message);
                    }
                },
                error: function(xhr, status, error) {
                    showToast('Có lỗi xảy ra: ' + error, false);
                }
            });
        }
    }

    // call init method
    getMessageFromLocastorage();

    setInterval(getMessageFromLocastorage, 5000);
</script>
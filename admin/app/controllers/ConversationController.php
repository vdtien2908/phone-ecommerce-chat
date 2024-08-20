<?php

class ConversationController extends BaseController
{

    private $conversationModel;
    private $messagesModel;
    /**
     * AuthController constructor.
     * Lớp ConversationController này quản lý các hành động liên quan
     * đến hội thoại và tin nhắn, bao gồm lấy dữ liệu hội thoại,
     * chi tiết hội thoại, cập nhật trạng thái tin nhắn, và tạo mới hội thoại
     * cũng như tin nhắn từ cả hai phía (quản trị viên và khách hàng)
     */
    public function __construct()
    {
        $this->conversationModel = $this->model('ConversationModel');
        $this->messagesModel = $this->model('MessagesModel');
    }

    /**
     * Phương thức index này lấy tất cả các hội thoại bằng cách gọi
     * phương thức getConversations của conversationModel và hiển thị
     * chúng trên trang /conversation/index.
     */
    public function index()
    {
        $conversations = $this->conversationModel->getConversations();

        // $json_string = json_encode($conversations, JSON_PRETTY_PRINT);
        // var_dump($json_string);

        $this->view('app', [
            'page' => '/conversation/index',
            'title' => 'Thông tin hội thoại',
            'conversations' => $conversations
        ]);
    }

    /**
     * Phương thức detail lấy chi tiết của một hội thoại cụ thể dựa trên ID,
     * cập nhật trạng thái của các tin nhắn trong hội thoại đó, và hiển thị chúng
     * trên trang /conversation/detail.
     */
    public function detail($id)
    {
        $conversations = $this->conversationModel->getConversation($id);

        // $json_string = json_encode($conversations, JSON_PRETTY_PRINT);
        // var_dump($json_string);

        foreach ($conversations as $con) {
            $this->messagesModel->updateMessage($con['id']);
        }

        $this->view('app', [
            'page' => '/conversation/detail',
            'title' => 'Thông tin hội thoại',
            'conversations' => $conversations
        ]);
    }

    /**
     * Phương thức này lấy tất cả các hội thoại của một khách hàng dựa trên ID khách hàng, sau đó trả về dữ liệu dưới dạng JSON.
     */
    public function getConversationByCustomerId($id)
    {
        $conversations = $this->conversationModel->getConversationByCustomer($id);

        $result = [
            'status' => 200,
            'message' => 'Get theo customer thành công',
            'data' => $conversations
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     *Phương thức này lấy chi tiết của một hội thoại cụ thể dựa trên ID hội thoại và trả về dữ liệu dưới dạng JSON.
     */
    public function getConversationByConversation($id)
    {
        $conversations = $this->conversationModel->getConversation($id);

        $result = [
            'status' => 200,
            'message' => 'Get theo conversation thành công',
            'data' => $conversations
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Phương thức này lấy chi tiết của một hội thoại cụ thể dựa trên ID và trả về dữ liệu dưới dạng JSON.
     */
    public function getDetailMessage($id)
    {
        $conversations = $this->conversationModel->getConversation($id);

        $result = [
            'status' => 200,
            'message' => 'Get thành công',
            'data' => $conversations
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Phương thức này cập nhật trạng thái của tất cả các tin nhắn trong một
     * hội thoại cụ thể dựa trên ID và trả về dữ liệu hội thoại dưới dạng JSON.
     */
    public function updateMessageStatus($id)
    {
        $conversations = $this->conversationModel->getConversation($id);

        foreach ($conversations as $con) {
            $this->messagesModel->updateMessage($con['id']);
        }

        $result = [
            'status' => 200,
            'message' => 'Get thành công',
            'data' => $conversations
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Phương thức này tạo một hội thoại mới không có khách hàng và trả về dữ liệu
     * của hội thoại mới nhất dưới dạng JSON. Nếu có lỗi, nó sẽ trả về thông báo lỗi.
     */
    public function store()
    {
        try {
            $this->conversationModel->createConversationNullCustomer();
            $conversation = $this->conversationModel->getLastestConversation();

            $result = [
                'status' => 200,
                'message' => 'Tao thành công',
                'data' => ['conversation' => $conversation]
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        } catch (\Throwable $th) {
            $result = [
                'status' => 500,
                'message' => $th->getMessage(),
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    /**
     * Phương thức này tạo một hội thoại mới cho một khách hàng cụ thể dựa trên ID khách hàng,
     * nếu hội thoại đó chưa tồn tại. Nếu hội thoại đã tồn tại, nó trả về thông báo rằng hội thoại đã tồn tại.
     * Nếu có lỗi, nó sẽ trả về thông báo lỗi.
     */
    public function storeConversationByCustomer($id)
    {
        try {
            $existingConversation = $this->conversationModel->getConversationByCustomer($id);

            if (empty($existingConversation)) {
                $this->conversationModel->createConversationWithCustomer($id);

                $result = [
                    'status' => 200,
                    'message' => 'Tạo thành công',
                ];

                header('Content-Type: application/json');
                echo json_encode($result);
                return;
            }

            $result = [
                'status' => 200,
                'message' => 'Đã tồn tại',
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        } catch (\Throwable $th) {
            $result = [
                'status' => 500,
                'message' => $th->getMessage(),
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    /**
     * Phương thức này tạo một tin nhắn mới từ quản trị viên gửi đến khách hàng
     * và trả về dữ liệu của tin nhắn mới tạo dưới dạng JSON. Nếu có lỗi, nó sẽ trả về thông báo lỗi.
     */
    public function createMessageByAdmin()
    {
        try {
            $data = [
                'cvs_id' => $_POST['cvs_id'],
                'content' => $_POST['content'],
                'status' => 0,
                'sender_type' => 'admin',
                'receiver_type' => 'customer'
            ];

            $createdCv = $this->messagesModel->createMessage($data);

            $result = [
                'status' => 200,
                'message' => 'Tạo thành công',
                'data' => $createdCv
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        } catch (\Throwable $th) {
            $result = [
                'status' => 500,
                'message' => $th->getMessage(),
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    /**
     * Phương thức này tạo một tin nhắn mới từ khách hàng gửi đến quản trị viên
     * và trả về dữ liệu của tin nhắn mới tạo dưới dạng JSON. Nếu có lỗi, nó sẽ trả về thông báo lỗi.
     */
    public function createMessageByCustomer()
    {
        try {
            $data = [
                'cvs_id' => $_POST['cvs_id'],
                'content' => $_POST['content'],
                'status' => 0,
                'sender_type' => 'customer',
                'receiver_type' => 'admin'
            ];

            $createdCv = $this->messagesModel->createMessage($data);

            $result = [
                'status' => 200,
                'message' => 'Tạo thành công',
                'data' => $createdCv
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        } catch (\Throwable $th) {
            $result = [
                'status' => 500,
                'message' => $th->getMessage(),
            ];

            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    /**
     * Xóa tin nhắn
     */
    public function deleteMessage($id)
    {
        $this->messagesModel->deleteMessage($id);

        $result = [
            'status' => 204,
            'message' => 'Đã xóa tin nhắn',
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }
}

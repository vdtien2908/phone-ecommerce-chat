<?php
class ConversationModel extends BaseModel
{
    const TableName = 'conversations';

    public function getConversations()
    {
        $sql = "SELECT c.id AS conversation_id, c.status AS conversation_status, m.*, m.status AS msg_status, cm.customer_name, cm.customer_id
                FROM conversations c
                JOIN messages m ON m.cvs_id = c.id
                LEFT JOIN customers cm ON cm.customer_id = c.customer_id
                ORDER BY m.created_at DESC";

        $result = $this->querySql($sql);
        if ($result) {
            $conversations = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $conversationId = $row['conversation_id'];

                // Tạo mới đối tượng conversation nếu chưa tồn tại
                if (!isset($conversations[$conversationId])) {
                    $conversations[$conversationId] = [
                        'id' => $conversationId,
                        'status' => $row['conversation_status'],
                        'customer_name' => $row['customer_name'],
                        'customer_id' => $row['customer_id'],
                        'messages' => []
                    ];
                }

                // Lấy tin nhắn cuối cùng cho conversation hiện tại
                $lastMessage = end($conversations[$conversationId]['messages']);
                if ($lastMessage === false || $row['created_at'] > $lastMessage['created_at']) {
                    $newMessage = [
                        'id' => $row['id'],
                        'cvs_id' => $row['cvs_id'],
                        'content' => $row['content'],
                        'status' => $row['msg_status'],
                        'created_at' => $row['created_at'],
                        'updated_at' => $row['updated_at']
                    ];
                    $conversations[$conversationId]['messages'][] = $newMessage;
                }
            }

            // Giải phóng bộ nhớ
            mysqli_free_result($result);

            // Chuyển đổi mảng kết quả thành mảng kết quả cuối cùng
            $finalConversations = array_values($conversations);

            return $finalConversations;
        }

        return [];
    }

    public function getConversation($id)
    {
        $sql = "SELECT c.id as conversation_id, c.status, m.*,m.id as msg_id, m.status AS 'msg_status', cm.customer_name, cm.customer_id
        FROM conversations c
        LEFT JOIN messages m ON m.cvs_id = c.id
        LEFT JOIN customers cm ON cm.customer_id = c.customer_id
        WHERE m.cvs_id = ${id}
        ORDER BY m.created_at ASC";

        $result = $this->querySql($sql);

        if ($result) {
            $conversations = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $conversations;
        }

        return [];
    }

    public function getConversationByCustomer($id)
    {
        $sql = "SELECT c.id as conversation_id, c.status, m.*,m.id as msg_id, m.status AS 'msg_status', cm.customer_name, cm.customer_id
        FROM conversations c
        LEFT JOIN messages m ON m.cvs_id = c.id
        LEFT JOIN customers cm ON cm.customer_id = c.customer_id
        WHERE c.customer_id = ${id}
        ORDER BY m.created_at ASC";

        $result = $this->querySql($sql);

        if ($result) {
            $conversations = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $conversations;
        }

        return [];
    }

    public function getLastestConversation()
    {
        $sql = "SELECT c.id as conversation_id, c.status, m.*, m.id as msg_id, m.status AS 'msg_status', cm.customer_name, cm.customer_id
        FROM conversations c
        LEFT JOIN messages m ON m.cvs_id = c.id
        LEFT JOIN customers cm ON cm.customer_id = c.customer_id
        ORDER BY c.created_at DESC LIMIT 1";

        $result = $this->querySql($sql);
        return mysqli_fetch_assoc($result);
    }

    public function createConversationNullCustomer()
    {
        $sql = "INSERT INTO conversations (customer_id, status) VALUES(NULL,0)";

        $result = $this->querySql($sql);
        return $result;
    }

    public function createConversationWithCustomer($id)
    {
        $sql = "INSERT INTO conversations (customer_id) VALUES(${id})";

        $result = $this->querySql($sql);
        return $result;
    }
}

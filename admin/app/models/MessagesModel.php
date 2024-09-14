<?php
class MessagesModel extends BaseModel
{
    const TableName = 'messages';

    public function createMessage($data)
    {
        $cvs_id = $data['cvs_id'];
        $content = $data['content'];
        $sender_type = $data['sender_type'];
        $receiver_type = $data['receiver_type'];

        $sql = "INSERT INTO messages (cvs_id, content, status, sender_type, receiver_type) VALUES ('{$cvs_id}', '{$content}', 0, '{$sender_type}', '{$receiver_type}')";
        $result = $this->querySql($sql);
        return $result;
    }

    public function updateMessage($id)
    {
        $sql = "UPDATE messages SET status = 1 WHERE id = ${id}";
        $result = $this->querySql($sql);
        return $result;
    }

    public function deleteMessage($id)
    {
        $sql = "DELETE FROM messages WHERE id = ${id}";
        $result = $this->querySql($sql);
        return $result;
    }
}

<?php
/**
 * Created by Tiago
 * Date: 13-01-2018
 * Time: 16:51
 */

include_once("Database.php");

/**
 * Class Session
 */
class Session
{
    /**
     * Insert new session in database
     * @param $user
     */
    public function insert($user)
    {
        $database = new Database();
        $this->set();
        $this->regenerate();
        $database->insert('sessao', '(?, ?, ?)', 'ssi', [session_id(), $user, time()]);
    }

    /**
     * Sets session
     */
    function set()
    {
        $_SESSION['authenticated'] = true;
        $_SESSION['timestamp'] = time();
    }

    /**
     * Session regeneration to avoid session fixation
     */
    public function regenerate()
    {
        session_regenerate_id(true);
    }

    /**
     * Destroy client session
     */
    public function destroy()
    {
        unset($_SESSION['authenticated']);
        unset($_SESSION['timestamp']);
        session_destroy();
    }

    public function renew()
    {
        $session = new Session();
        $oldSessionId = $session->get();
        if (!$this->isExpired()) {
            $session->update('id', $oldSessionId);
        } else {
            logOut();
        }
    }

    /**
     * Get current session id
     * @return string
     */
    function get()
    {
        return session_id();
    }

    /**
     * Check for expired sessions
     * @return bool
     */
    public function isExpired()
    {
        $this->delete();
        $database = new Database();
        $sessionId = $this->get();
        $result = $database->select('id', 'sessao', 'id = ?', 's', [$sessionId]);
        if ($result->num_rows > 0) {
            return false;
        }
        return true;
    }

    /**
     * Deletes expired sessions ($id = null) or deletes a specific session when $id is set
     * @param null $id
     */
    public function delete($id = null)
    {
        $where = 'data + 3600 < unix_timestamp()';
        $bind_params = null;
        $values = null;
        $database = new Database();
        if (!is_null($id)) {
            $where = 'id = ?';
            $bind_params = 's';
            $values = [$id];
        }
        $database->delete('sessao', $where, $bind_params, $values);
    }

    /**
     * Updates session when an important action is executed
     * @param $column
     * @param $value
     */
    public function update($column, $value)
    {
        $database = new Database();
        $this->regenerate();
        $where = $column . ' = ?';
        $database->update(
            'sessao',
            'id = ?, data = ?',
            $where,
            'sis',
            [$this->get(), time(), $value]
        );
        $this->set();
    }
}

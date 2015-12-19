<?php

namespace Ais\StatusKeaktifanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ais\StatusKeaktifanBundle\Model\StatusKeaktifanInterface;

/**
 * StatusKeaktifan
 */
class StatusKeaktifan implements StatusKeaktifanInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $mahasiswa_id;

    /**
     * @var integer
     */
    private $status_keaktifan;

    /**
     * @var boolean
     */
    private $is_active;

    /**
     * @var boolean
     */
    private $is_delete;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set mahasiswaId
     *
     * @param integer $mahasiswaId
     *
     * @return StatusKeaktifan
     */
    public function setMahasiswaId($mahasiswaId)
    {
        $this->mahasiswa_id = $mahasiswaId;

        return $this;
    }

    /**
     * Get mahasiswaId
     *
     * @return integer
     */
    public function getMahasiswaId()
    {
        return $this->mahasiswa_id;
    }

    /**
     * Set statusKeaktifan
     *
     * @param integer $statusKeaktifan
     *
     * @return StatusKeaktifan
     */
    public function setStatusKeaktifan($statusKeaktifan)
    {
        $this->status_keaktifan = $statusKeaktifan;

        return $this;
    }

    /**
     * Get statusKeaktifan
     *
     * @return integer
     */
    public function getStatusKeaktifan()
    {
        return $this->status_keaktifan;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return StatusKeaktifan
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     *
     * @return StatusKeaktifan
     */
    public function setIsDelete($isDelete)
    {
        $this->is_delete = $isDelete;

        return $this;
    }

    /**
     * Get isDelete
     *
     * @return boolean
     */
    public function getIsDelete()
    {
        return $this->is_delete;
    }
    /**
     * @var integer
     */
    private $semester_id;


    /**
     * Set semesterId
     *
     * @param integer $semesterId
     *
     * @return StatusKeaktifan
     */
    public function setSemesterId($semesterId)
    {
        $this->semester_id = $semesterId;

        return $this;
    }

    /**
     * Get semesterId
     *
     * @return integer
     */
    public function getSemesterId()
    {
        return $this->semester_id;
    }
}

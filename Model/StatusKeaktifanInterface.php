<?php

namespace Ais\StatusKeaktifanBundle\Model;

Interface StatusKeaktifanInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set mahasiswaId
     *
     * @param integer $mahasiswaId
     *
     * @return StatusKeaktifan
     */
    public function setMahasiswaId($mahasiswaId);

    /**
     * Get mahasiswaId
     *
     * @return integer
     */
    public function getMahasiswaId();

    /**
     * Set statusKeaktifan
     *
     * @param integer $statusKeaktifan
     *
     * @return StatusKeaktifan
     */
    public function setStatusKeaktifan($statusKeaktifan);

    /**
     * Get statusKeaktifan
     *
     * @return integer
     */
    public function getStatusKeaktifan();

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return StatusKeaktifan
     */
    public function setIsActive($isActive);

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive();

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     *
     * @return StatusKeaktifan
     */
    public function setIsDelete($isDelete);

    /**
     * Get isDelete
     *
     * @return boolean
     */
    public function getIsDelete();
    
    /**
     * Set semesterId
     *
     * @param integer $semesterId
     *
     * @return StatusKeaktifan
     */
    public function setSemesterId($semesterId);

    /**
     * Get semesterId
     *
     * @return integer
     */
    public function getSemesterId();
}

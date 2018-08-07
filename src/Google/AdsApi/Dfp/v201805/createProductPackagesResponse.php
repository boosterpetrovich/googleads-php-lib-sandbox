<?php

namespace Google\AdsApi\Dfp\v201805;


/**
 * This file was generated from WSDL. DO NOT EDIT.
 */
class createProductPackagesResponse
{

    /**
     * @var \Google\AdsApi\Dfp\v201805\ProductPackage[] $rval
     */
    protected $rval = null;

    /**
     * @param \Google\AdsApi\Dfp\v201805\ProductPackage[] $rval
     */
    public function __construct(array $rval = null)
    {
      $this->rval = $rval;
    }

    /**
     * @return \Google\AdsApi\Dfp\v201805\ProductPackage[]
     */
    public function getRval()
    {
      return $this->rval;
    }

    /**
     * @param \Google\AdsApi\Dfp\v201805\ProductPackage[] $rval
     * @return \Google\AdsApi\Dfp\v201805\createProductPackagesResponse
     */
    public function setRval(array $rval)
    {
      $this->rval = $rval;
      return $this;
    }

}

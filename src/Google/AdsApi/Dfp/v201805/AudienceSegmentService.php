<?php

namespace Google\AdsApi\Dfp\v201805;


/**
 * This file was generated from WSDL. DO NOT EDIT.
 */
class AudienceSegmentService extends \Google\AdsApi\Common\AdsSoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
      'ObjectValue' => 'Google\\AdsApi\\Dfp\\v201805\\ObjectValue',
      'ActivateAudienceSegments' => 'Google\\AdsApi\\Dfp\\v201805\\ActivateAudienceSegments',
      'AdUnitTargeting' => 'Google\\AdsApi\\Dfp\\v201805\\AdUnitTargeting',
      'ApiError' => 'Google\\AdsApi\\Dfp\\v201805\\ApiError',
      'ApiException' => 'Google\\AdsApi\\Dfp\\v201805\\ApiException',
      'ApiVersionError' => 'Google\\AdsApi\\Dfp\\v201805\\ApiVersionError',
      'ApplicationException' => 'Google\\AdsApi\\Dfp\\v201805\\ApplicationException',
      'ApproveAudienceSegments' => 'Google\\AdsApi\\Dfp\\v201805\\ApproveAudienceSegments',
      'AudienceSegmentDataProvider' => 'Google\\AdsApi\\Dfp\\v201805\\AudienceSegmentDataProvider',
      'AudienceSegmentPage' => 'Google\\AdsApi\\Dfp\\v201805\\AudienceSegmentPage',
      'AuthenticationError' => 'Google\\AdsApi\\Dfp\\v201805\\AuthenticationError',
      'FirstPartyAudienceSegment' => 'Google\\AdsApi\\Dfp\\v201805\\FirstPartyAudienceSegment',
      'BooleanValue' => 'Google\\AdsApi\\Dfp\\v201805\\BooleanValue',
      'CollectionSizeError' => 'Google\\AdsApi\\Dfp\\v201805\\CollectionSizeError',
      'CommonError' => 'Google\\AdsApi\\Dfp\\v201805\\CommonError',
      'CustomCriteria' => 'Google\\AdsApi\\Dfp\\v201805\\CustomCriteria',
      'CustomCriteriaSet' => 'Google\\AdsApi\\Dfp\\v201805\\CustomCriteriaSet',
      'CustomCriteriaLeaf' => 'Google\\AdsApi\\Dfp\\v201805\\CustomCriteriaLeaf',
      'CustomCriteriaNode' => 'Google\\AdsApi\\Dfp\\v201805\\CustomCriteriaNode',
      'AudienceSegmentCriteria' => 'Google\\AdsApi\\Dfp\\v201805\\AudienceSegmentCriteria',
      'Date' => 'Google\\AdsApi\\Dfp\\v201805\\Date',
      'DateTime' => 'Google\\AdsApi\\Dfp\\v201805\\DateTime',
      'DateTimeValue' => 'Google\\AdsApi\\Dfp\\v201805\\DateTimeValue',
      'DateValue' => 'Google\\AdsApi\\Dfp\\v201805\\DateValue',
      'DeactivateAudienceSegments' => 'Google\\AdsApi\\Dfp\\v201805\\DeactivateAudienceSegments',
      'EntityChildrenLimitReachedError' => 'Google\\AdsApi\\Dfp\\v201805\\EntityChildrenLimitReachedError',
      'EntityLimitReachedError' => 'Google\\AdsApi\\Dfp\\v201805\\EntityLimitReachedError',
      'ThirdPartyAudienceSegment' => 'Google\\AdsApi\\Dfp\\v201805\\ThirdPartyAudienceSegment',
      'FeatureError' => 'Google\\AdsApi\\Dfp\\v201805\\FeatureError',
      'FieldPathElement' => 'Google\\AdsApi\\Dfp\\v201805\\FieldPathElement',
      'InternalApiError' => 'Google\\AdsApi\\Dfp\\v201805\\InternalApiError',
      'InventoryTargeting' => 'Google\\AdsApi\\Dfp\\v201805\\InventoryTargeting',
      'Money' => 'Google\\AdsApi\\Dfp\\v201805\\Money',
      'NonRuleBasedFirstPartyAudienceSegment' => 'Google\\AdsApi\\Dfp\\v201805\\NonRuleBasedFirstPartyAudienceSegment',
      'NotNullError' => 'Google\\AdsApi\\Dfp\\v201805\\NotNullError',
      'NumberValue' => 'Google\\AdsApi\\Dfp\\v201805\\NumberValue',
      'ParseError' => 'Google\\AdsApi\\Dfp\\v201805\\ParseError',
      'PermissionError' => 'Google\\AdsApi\\Dfp\\v201805\\PermissionError',
      'PopulateAudienceSegments' => 'Google\\AdsApi\\Dfp\\v201805\\PopulateAudienceSegments',
      'PublisherQueryLanguageContextError' => 'Google\\AdsApi\\Dfp\\v201805\\PublisherQueryLanguageContextError',
      'PublisherQueryLanguageSyntaxError' => 'Google\\AdsApi\\Dfp\\v201805\\PublisherQueryLanguageSyntaxError',
      'FirstPartyAudienceSegmentRule' => 'Google\\AdsApi\\Dfp\\v201805\\FirstPartyAudienceSegmentRule',
      'QuotaError' => 'Google\\AdsApi\\Dfp\\v201805\\QuotaError',
      'RejectAudienceSegments' => 'Google\\AdsApi\\Dfp\\v201805\\RejectAudienceSegments',
      'RequiredCollectionError' => 'Google\\AdsApi\\Dfp\\v201805\\RequiredCollectionError',
      'RequiredError' => 'Google\\AdsApi\\Dfp\\v201805\\RequiredError',
      'RuleBasedFirstPartyAudienceSegment' => 'Google\\AdsApi\\Dfp\\v201805\\RuleBasedFirstPartyAudienceSegment',
      'RuleBasedFirstPartyAudienceSegmentSummary' => 'Google\\AdsApi\\Dfp\\v201805\\RuleBasedFirstPartyAudienceSegmentSummary',
      'AudienceSegmentAction' => 'Google\\AdsApi\\Dfp\\v201805\\AudienceSegmentAction',
      'AudienceSegment' => 'Google\\AdsApi\\Dfp\\v201805\\AudienceSegment',
      'AudienceSegmentError' => 'Google\\AdsApi\\Dfp\\v201805\\AudienceSegmentError',
      'ServerError' => 'Google\\AdsApi\\Dfp\\v201805\\ServerError',
      'SetValue' => 'Google\\AdsApi\\Dfp\\v201805\\SetValue',
      'SharedAudienceSegment' => 'Google\\AdsApi\\Dfp\\v201805\\SharedAudienceSegment',
      'SoapRequestHeader' => 'Google\\AdsApi\\Dfp\\v201805\\SoapRequestHeader',
      'SoapResponseHeader' => 'Google\\AdsApi\\Dfp\\v201805\\SoapResponseHeader',
      'Statement' => 'Google\\AdsApi\\Dfp\\v201805\\Statement',
      'StatementError' => 'Google\\AdsApi\\Dfp\\v201805\\StatementError',
      'StringFormatError' => 'Google\\AdsApi\\Dfp\\v201805\\StringFormatError',
      'StringLengthError' => 'Google\\AdsApi\\Dfp\\v201805\\StringLengthError',
      'String_ValueMapEntry' => 'Google\\AdsApi\\Dfp\\v201805\\String_ValueMapEntry',
      'TextValue' => 'Google\\AdsApi\\Dfp\\v201805\\TextValue',
      'TypeError' => 'Google\\AdsApi\\Dfp\\v201805\\TypeError',
      'UpdateResult' => 'Google\\AdsApi\\Dfp\\v201805\\UpdateResult',
      'Value' => 'Google\\AdsApi\\Dfp\\v201805\\Value',
      'createAudienceSegmentsResponse' => 'Google\\AdsApi\\Dfp\\v201805\\createAudienceSegmentsResponse',
      'getAudienceSegmentsByStatementResponse' => 'Google\\AdsApi\\Dfp\\v201805\\getAudienceSegmentsByStatementResponse',
      'performAudienceSegmentActionResponse' => 'Google\\AdsApi\\Dfp\\v201805\\performAudienceSegmentActionResponse',
      'updateAudienceSegmentsResponse' => 'Google\\AdsApi\\Dfp\\v201805\\updateAudienceSegmentsResponse',
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(),
                $wsdl = 'https://ads.google.com/apis/ads/publisher/v201805/AudienceSegmentService?wsdl')
    {
      foreach (self::$classmap as $key => $value) {
        if (!isset($options['classmap'][$key])) {
          $options['classmap'][$key] = $value;
        }
      }
      $options = array_merge(array (
      'features' => 1,
    ), $options);
      parent::__construct($wsdl, $options);
    }

    /**
     * Creates new {@link RuleBasedFirstPartyAudienceSegment} objects.
     *
     * @param \Google\AdsApi\Dfp\v201805\FirstPartyAudienceSegment[] $segments
     * @return \Google\AdsApi\Dfp\v201805\FirstPartyAudienceSegment[]
     * @throws \Google\AdsApi\Dfp\v201805\ApiException
     */
    public function createAudienceSegments(array $segments)
    {
      return $this->__soapCall('createAudienceSegments', array(array('segments' => $segments)))->getRval();
    }

    /**
     * Gets an {@link AudienceSegmentPage} of {@link AudienceSegment} objects that satisfy the given
     * {@link Statement#query}. The following fields are supported for filtering:
     *
     * <table>
     * <tr>
     * <th scope="col">PQL Property</th>
     * <th scope="col">Object Property</th>
     * </tr>
     * <tr>
     * <td>{@code id}</td>
     * <td>{@link AudienceSegment#id}</td>
     * </tr>
     * <tr>
     * <td>{@code name}</td>
     * <td>{@link AudienceSegment#name}</td>
     * </tr>
     * <tr>
     * <td>{@code status}</td>
     * <td>{@link AudienceSegment#status}</td>
     * </tr>
     * <tr>
     * <td>{@code type}</td>
     * <td>{@link AudienceSegment#type}</td>
     * </tr>
     * <tr>
     * <td>{@code size}</td>
     * <td>{@link AudienceSegment#size}</td>
     * </tr>
     * <tr>
     * <td>{@code dataProviderName}</td>
     * <td>{@link AudienceSegmentDataProvider#name}</td>
     * </tr>
     * <tr>
     * <td>{@code approvalStatus}</td>
     * <td>{@link ThirdPartyAudienceSegment#approvalStatus}</td>
     * </tr>
     * <tr>
     * <td>{@code cost}</td>
     * <td>{@link ThirdPartyAudienceSegment#cost}</td>
     * </tr>
     * <tr>
     * <td>{@code startDateTime}</td>
     * <td>{@link ThirdPartyAudienceSegment#startDateTime}</td>
     * </tr>
     * <tr>
     * <td>{@code endDateTime}</td>
     * <td>{@link ThirdPartyAudienceSegment#endDateTime}</td>
     * </tr>
     * </table>
     *
     * segments
     *
     * @param \Google\AdsApi\Dfp\v201805\Statement $filterStatement
     * @return \Google\AdsApi\Dfp\v201805\AudienceSegmentPage
     * @throws \Google\AdsApi\Dfp\v201805\ApiException
     */
    public function getAudienceSegmentsByStatement(\Google\AdsApi\Dfp\v201805\Statement $filterStatement)
    {
      return $this->__soapCall('getAudienceSegmentsByStatement', array(array('filterStatement' => $filterStatement)))->getRval();
    }

    /**
     * Performs the given {@link AudienceSegmentAction} on the set of segments identified by the given
     * statement.
     *
     * segments
     *
     * @param \Google\AdsApi\Dfp\v201805\AudienceSegmentAction $action
     * @param \Google\AdsApi\Dfp\v201805\Statement $filterStatement
     * @return \Google\AdsApi\Dfp\v201805\UpdateResult
     * @throws \Google\AdsApi\Dfp\v201805\ApiException
     */
    public function performAudienceSegmentAction(\Google\AdsApi\Dfp\v201805\AudienceSegmentAction $action, \Google\AdsApi\Dfp\v201805\Statement $filterStatement)
    {
      return $this->__soapCall('performAudienceSegmentAction', array(array('action' => $action, 'filterStatement' => $filterStatement)))->getRval();
    }

    /**
     * Updates the given {@link RuleBasedFirstPartyAudienceSegment} objects.
     *
     * @param \Google\AdsApi\Dfp\v201805\FirstPartyAudienceSegment[] $segments
     * @return \Google\AdsApi\Dfp\v201805\FirstPartyAudienceSegment[]
     * @throws \Google\AdsApi\Dfp\v201805\ApiException
     */
    public function updateAudienceSegments(array $segments)
    {
      return $this->__soapCall('updateAudienceSegments', array(array('segments' => $segments)))->getRval();
    }

}
